<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
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

        $query = Order::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('total_price', 'like', '%' . $search . '%');
                // You may add more search conditions here
            });
        }

        $orders = $query->paginate($perPage);
        $totalorders = Order::count();

        return view('dashboard.orders.index', compact('orders', 'totalorders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return a view to create a new order
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
            // Add more validation rules as needed
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Order::create($request->all());

        return redirect()->route('ordersdash.index')->with('success', 'Order created successfully!');
    }

    public function trashed(Request $request)
    {
        $totaltrashedorders= Order::onlyTrashed()->count();
     
        // Fetch trashed users with pagination
        $orders = Order::onlyTrashed()->paginate(5);
    
        return view('dashboard.orders.trashed', compact('orders', 'totaltrashedorders'));
    }

    public function restore($id)
    {
        $orders = Order::onlyTrashed()->findOrFail($id);
        $orders->restore();

        return redirect()->route('orders.trashed')->with('success', 'orders restored successfully.');
    }
    public function forceDelete($id)
    {
        $orders = Order::onlyTrashed()->findOrFail($id);
        $orders->forceDelete();

        return redirect()->route('orders.trashed')->with('success', 'orders permanently deleted.');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $order = Order::findOrFail($id);
    //     return view('dashboard.orders.show', compact('order'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $users = User::all(); // Retrieve all users
        $categories = Category::all(); // Retrieve all categories
        $products = Product::all(); // Retrieve all products if needed
        return view('dashboard.orders.edit', compact('order', 'users', 'categories'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request data
        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;
        $order->save();
    
        return redirect()->route('ordersdash.index')->with('success', 'Order status updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('ordersdash.index')->with('success', 'Order deleted successfully!');
    }
}
