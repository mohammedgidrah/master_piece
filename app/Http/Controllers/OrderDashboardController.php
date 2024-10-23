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
    
         $query->join('users', 'orders.customer_id', '=', 'users.id') 
              ->join('products', 'orders.product_id', '=', 'products.id')
              ->select('orders.*', 'users.first_name', 'users.last_name', 'products.name as product_name');
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('orders.total_price', 'like', '%' . $search . '%')
                  ->orWhere('orders.order_status', 'like', '%' . $search . '%')
                  ->orWhere('users.first_name', 'like', '%' . $search . '%')
                  ->orWhere('users.last_name', 'like', '%' . $search . '%')
                  ->orWhere('products.name', 'like', '%' . $search . '%');
            });
        }

 
    
        $orders = $query->paginate($perPage);
        $totalOrders = Order::count();
    
        return view('dashboard.orders.index', compact('orders', 'totalOrders'));
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
         ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Order::create($request->all());

        return redirect()->route('ordersdash.index')->with('success', 'Order created successfully!');
    }

    public function trashed(Request $request)
    {
        $totalTrashedOrders = Order::onlyTrashed()->count();
    
         $orders = Order::onlyTrashed()->paginate(5);
    
        return view('dashboard.orders.trashed', compact('orders', 'totalTrashedOrders'));
    }
    

    public function restore($id)
    {
        $orders = Order::onlyTrashed()->findOrFail($id);
        $orders->restore();

        return redirect()->route('ordersdash.trashed')->with('success', 'orders restored successfully.');
    }
    public function forceDelete($id)
    {
        $orders = Order::onlyTrashed()->findOrFail($id);
        $orders->forceDelete();

        return redirect()->route('ordersdash.trashed')->with('success', 'orders permanently deleted.');
    }

  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);
    
        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;
    
        if ($order->save()) {
            return redirect()->route('ordersdash.index')->with('success', 'Order status updated successfully.');
        } else {
            return redirect()->route('ordersdash.index')->with('error', 'Failed to update order status.');
        }
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
