<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $orders = Order::with('product')
            ->when($search, function ($query, $search) {
                return $query->whereHas('product', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            })
            ->paginate(5);

        return view('homepage.orders.index', compact('orders'));
    }

    public function store(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You need to log in first to place an order.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'total_price' => 'required|numeric',
            'order_status' => 'in:pending,processing,shipped,delivered,cancelled',
        ]);

        $existingOrder = Order::where('customer_id', auth()->user()->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingOrder) {
            return redirect()->back()->with('error', 'The product is already in your cart.');
        }

        $order = Order::create([
            'customer_id' => auth()->user()->id,
            'total_price' => $request->total_price,
            'order_status' => $request->order_status ?? 'pending',
            'product_id' => $request->product_id,
            'quantity' => 1,
        ]);

        if ($order) {
            return redirect()->back()->with('success', 'Product has been added to your cart.');
        } else {
            return redirect()->back()->with('error', 'Failed to add the product to your cart. Please try again.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $orders = Order::find($id);

        if ($orders) {
            $orders->quantity = $request->quantity;

            $product = Product::find($orders->product_id);
            if ($product) {
                $orders->total_price = $product->price * $orders->quantity;
            }

            $orders->save();

            return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
        }

        return redirect()->route('orders.index')->with('error', 'Order not found.');
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
    
        // Check if the user has any orders
        $orders = $user->orders()->with('product')->get(); // Load related product data
    
        if ($orders->isEmpty()) {
            return redirect()->route('orders.index')->with('error', 'Your cart is empty.');
        }
    
        // Start a database transaction
        // DB::beginTransaction();
    
        try {
            // Calculate the total for all orders
            $total = $orders->sum(function ($order) {
                return $order->product->price * $order->quantity;
            });
    
            // Check stock availability for all products before making any changes
            foreach ($orders as $order) {
                $product = $order->product; // Access product directly
                
                if (!$product) {
                    // If product is not found, rollback and return an error
                    DB::rollBack();
                    Log::error('Checkout Error: Product not found for order ID: ' . $order->id);
                    return redirect()->route('orders.index')->with('error', 'Product not found for order: ' . $order->id);
                }
    
                $currentStock = (int) $product->quantity;
                $newStock = $currentStock - $order->quantity;
    
                Log::info("Checking stock for {$product->name}: current stock is {$currentStock}, required is {$order->quantity}");
    
                if ($newStock < 0) {
                    // If any product has insufficient stock, rollback and return an error
                    DB::rollBack();
                    Log::error('Checkout Error: Not enough stock for ' . $product->name);
                    return redirect()->route('orders.index')->with('error', 'Not enough stock for ' . $product->name);
                }
            }
    
            // Update stock and clear orders
            foreach ($orders as $order) {
                $product = $order->product;
                $product->quantity -= $order->quantity;
                $product->save();
    
                // Clear the order from the user's cart
                $order->delete(); // Clear the order after processing
            }
    
            // Commit the transaction
            // DB::commit();
    
            // Redirect to a success page
            return view('homepage.orders.success')->with('success', 'Checkout completed successfully.');
    
        } catch (\Exception $e) {
            // If there's an error, rollback the transaction
            // DB::rollBack();
    
            // Log the error for debugging purposes
            Log::error('Checkout Error: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
    
            // Redirect back with an error message
            return redirect()->route('orders.index')->with('error', 'An error occurred during checkout. Please try again. Details: ' . $e->getMessage());
        }
    }
    
    
    

    public function destroy($id)
    {
        $orders = Order::find($id);

        if ($orders) {
            $orders->delete();

            return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
        }

        return redirect()->back()->with('error', 'Order not found.');
    }
}
