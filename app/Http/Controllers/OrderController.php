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
        $orders = Order::paginate(10); // Adjust as necessary
        return view('homepage.orders.index', compact('orders'));
    }

    public function store(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'product_id' => 'required|exists:products,id', // Ensure product_id is required and valid
            'total_price' => 'required|numeric',
            'order_status' => 'in:pending,processing,shipped,delivered,cancelled',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        // Find the product by its ID
 

        // Create a new order
        $order = Order::create([
            'customer_id' => $request->customer_id ?? auth()->user()->id, // Fallback to the authenticated user ID
            'total_price' => $request->total_price,
            'order_status' => $request->order_status ?? 'pending',
            'product_id' => $request->product_id,
         ]);

        // Check if the order was created successfully
        if ($order) {
            // Fetch user's orders
            $user = auth()->user();
            $orders = $user->orders()->latest()->get();

            return view('homepage.orders.index', compact('orders'))
                ->with('success', 'Product has been added to your order.');
        } else {
            return redirect()->back()->with('error', 'Failed to create order. Please try again.');
        }
    }
}
