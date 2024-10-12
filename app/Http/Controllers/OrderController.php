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
        // Fetch paginated orders
        $orders = Order::all(); // Adjust as necessary
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
            // 'image' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
        ]);
    
        // Create a new order
        $order = Order::create([
            'customer_id' => auth()->user()->id, // Fallback to the authenticated user ID
            'total_price' => $request->total_price,
            'order_status' => $request->order_status ?? 'pending',
            'product_id' => $request->product_id,
        ]);
    
        // Check if the order was created successfully
        if ($order) {
            // Redirect to a different page after successful order creation to avoid duplicate submission
            return redirect()->back()->with('success', 'Product has been added to your order.');
        } else {
            return redirect()->back()->with('error', 'Failed to create order. Please try again.');
        }
    }
    public function destroy($id)
    {
        // Find the order by ID
        $order = Order::find($id);

        if ($order) {
            // Delete the order
            $order->delete();

            // Redirect back with a success message
            return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
        }

        // Redirect back with an error message if not found
        return redirect()->route('orders.index')->with('error', 'Order not found.');
    }
    
}
