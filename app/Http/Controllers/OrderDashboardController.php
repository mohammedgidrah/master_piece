<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);

        if ($perPage === 'all' || $perPage > 20) {
            $perPage = 20;
        }

        $search = $request->input('search');

        $query = OrderItem::with(['product', 'order.user']) // Eager-load relationships
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('users', 'orders.customer_id', '=', 'users.id')
            ->select('order_items.*', 'users.first_name', 'users.last_name', 'products.name as product_name', 'products.image', 'products.price', 'orders.order_status');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('order_items.total_price', 'like', '%' . $search . '%')
                    ->orWhere('orders.order_status', 'like', '%' . $search . '%')
                    ->orWhere('users.first_name', 'like', '%' . $search . '%')
                    ->orWhere('users.last_name', 'like', '%' . $search . '%')
                    ->orWhere('products.name', 'like', '%' . $search . '%');
            });
        }

        $orders = $query->paginate($perPage);
        $totalOrders = OrderItem::count();

        return view('dashboard.orders.index', compact('orders', 'totalOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
            'total_price' => 'required|numeric',
            'order_status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Order::create($request->all());

        return redirect()->route('ordersdash.index')->with('success', 'Order created successfully!');
    }

    public function show($id)
    {
        $order = Order::with('Allproducts')->findOrFail($id);
        return view('dashboard.orders.show', compact('order'));
    }

    public function checkout(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'billing_city' => 'required|string',
            'billing_address' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $totalPrice = 0;
            $user = Auth::user();
            $orders = $user->orders()->with('product')->get();

            if ($orders->isEmpty()) {
                return redirect()->route('orders.index')->with('error', 'Your cart is empty.');
            }

            foreach ($validatedData['product_id'] as $index => $productId) {
                $quantity = $validatedData['quantity'][$index];
                $product = Product::find($productId);
                $totalPrice += $product->price * $quantity;

                if ($product->quantity < $quantity) {
                    DB::rollBack();
                    Log::error('Checkout Error: Not enough stock for ' . $product->name);
                    return redirect()->route('orders.index')->with('error', 'Not enough stock for ' . $product->name);
                }
            }

            $order = Order::create([
                'customer_name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
                'total_price' => $totalPrice,
                'order_status' => 'pending',
            ]);

            foreach ($validatedData['product_id'] as $index => $productId) {
                $quantity = $validatedData['quantity'][$index];
                $product = Product::find($productId);
                $totalPrice = $product->price * $quantity;

                OrderItem::create([
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price_per_unit' => $product->price,
                    'total_price' => $totalPrice,
                ]);

                $product->quantity -= $quantity;
                $product->save();
            }

            // Assuming the Billing model exists
            $billing = new Billing();
            $billing->user_id = $user->id;
            $billing->first_name = $validatedData['first_name'];
            $billing->last_name = $validatedData['last_name'];
            $billing->email = $validatedData['email'];
            $billing->phone = $validatedData['phone'];
            $billing->billing_city = $validatedData['billing_city'];
            $billing->billing_address = $validatedData['billing_address'];
            $billing->order_id = $order->id;
            $billing->save();

            foreach ($orders as $orderToDelete) {
                $orderToDelete->delete();
            }

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Checkout completed successfully. Billing details saved.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Error: ' . $e->getMessage());
            return redirect()->route('orders.index')->with('error', 'An error occurred during checkout. Please try again. Details: ' . $e->getMessage());
        }
    }

    public function trashed(Request $request)
    {
        $totalTrashedOrders = Order::onlyTrashed()->count();
        $orders = Order::onlyTrashed()->paginate(5);
        return view('dashboard.orders.trashed', compact('orders', 'totalTrashedOrders'));
    }

    public function restore($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->restore();

        return redirect()->route('ordersdash.trashed')->with('success', 'Order restored successfully.');
    }

    public function forceDelete($id)
    {
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->forceDelete();

        return redirect()->route('ordersdash.trashed')->with('success', 'Order permanently deleted.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $orderId)
    {
        // Validate the incoming request
        $request->validate([
            'order_status' => 'required|in:pending,processing,delivered,cancelled',
        ]);
    
        // Update the status for all order items with this order_id
        $updated = OrderItem::where('order_id', $orderId)
                    ->update(['order_status' => $request->order_status]);
    
        // Check if any records were updated
        if ($updated) {
            return redirect()->route('ordersdash.index')->with('success', 'Order status updated successfully.');
        }
    
        // If no records were updated, handle it appropriately
        return redirect()->route('ordersdash.index')->with('error', 'No order items were updated.');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();

        return redirect()->route('ordersdash.index')->with('success', 'Order deleted successfully!');
    }
}
