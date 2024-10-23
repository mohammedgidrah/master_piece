<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

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
