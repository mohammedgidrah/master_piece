<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            ->paginate(1); // Adjust the number of items per page as needed
    
        return view('homepage.orders.index', compact('orders'));
    }
    

    public function store(Request $request, $id)
    {
        // Ensure the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You need to log in first to place an order.');
        }
    
        // Validate the incoming request
        $request->validate([
            'product_id' => 'required|exists:products,id', // Ensure product_id is required and valid
            'total_price' => 'required|numeric',
            'order_status' => 'in:pending,processing,shipped,delivered,cancelled',
        ]);
    
        // Check if the product is already in the user's orders
        $existingOrder = Order::where('customer_id', auth()->user()->id)
            ->where('product_id', $request->product_id)
            ->first();
    
        if ($existingOrder) {
            // If the product is already in the cart, show a message
            return redirect()->back()->with('error', 'The product is already in your cart.');
        }
    
        // Create a new order
        $order = Order::create([
            'customer_id' => auth()->user()->id, // Fallback to the authenticated user ID
            'total_price' => $request->total_price,
            'order_status' => $request->order_status ?? 'pending',
            'product_id' => $request->product_id,
            'quantity' => 1, // You might want to set a default quantity for a new order
        ]);
    
        // Check if the order was created successfully
        if ($order) {
            return redirect()->back()->with('success', 'Product has been added to your cart.');
        } else {
            return redirect()->back()->with('error', 'Failed to add the product to your cart. Please try again.');
        }
    }
    

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'quantity' => 'required|integer|min:1', // Ensure quantity is required and at least 1
        ]);

        // Find the orders by ID
        $orders = Order::find($id);

        if ($orders) {
            // Update the quantity
            $orders->quantity = $request->quantity;

            // Update total price based on the product price
            $product = Product::find($orders->product_id);
            if ($product) {
                $orders->total_price = $product->price * $orders->quantity;
            }

            // Save the orders
            $orders->save();

            // Redirect back with a success message
            return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
        }

        // Redirect back with an error message if not found
        return redirect()->route('orders.index')->with('error', 'Order not found.');
    }

    public function destroy($id)
    {
        // Find the orders by ID
        $orders = Order::find($id);

        if ($orders) {
            // Delete the orders
            $orders->delete();

            // Redirect back with a success message
            return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
        }

        // Redirect back with an error message if not found
        return redirect()->back()->with('error', 'Order not found.');
    }
}
