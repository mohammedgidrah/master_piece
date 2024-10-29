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
        // Get pagination setting
        $perPage = $request->input('per_page', 5);
        
        // Set maximum per page limit
        if ($perPage === 'all' || $perPage > 20) {
            $perPage = 20;
        }
        
        // Get search input and order status filter
        $search = $request->input('search');
        $orderStatus = $request->input('order_status');
        
        // Build the query
        $query = OrderItem::with(['order.user', 'product'])
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('users', 'orders.customer_id', '=', 'users.id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select('order_items.*', 'users.first_name', 'users.last_name', 'products.name as product_name', 'products.image', 'products.price', 'orders.order_status');
        
        // Apply search filters
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('order_items.total_price', 'like', '%' . $search . '%')
                  ->orWhere('users.first_name', 'like', '%' . $search . '%')
                  ->orWhere('users.last_name', 'like', '%' . $search . '%');
            });
        }
        
        // Apply order status filter
        if ($orderStatus) {
            $query->where('orders.order_status', $orderStatus);
        }
        
        // Pagination
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

 

    public function trashed(Request $request)
    {
        $totalTrashedOrders = OrderItem::onlyTrashed()->count();
        $orders = OrderItem::onlyTrashed()->paginate(5);
        return view('dashboard.orders.trashed', compact('orders', 'totalTrashedOrders'));
    }

    public function restore($id)
    {
        $order = OrderItem::onlyTrashed()->findOrFail($id);
        $order->restore();

        return redirect()->route('ordersdash.trashed')->with('success', 'Order restored successfully.');
    }

    public function forceDelete($id)
    {
        $order = OrderItem::onlyTrashed()->findOrFail($id);
        $order->forceDelete();

        return redirect()->route('ordersdash.trashed')->with('success', 'Order permanently deleted.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $orderId)
    {
        $request->validate([
            'order_status' => 'required|in:pending,processing,delivered,cancelled',
        ]);
    
        DB::beginTransaction();
        try {
            // Check if the order is soft-deleted
            $order = Order::withTrashed()->find($orderId);
    
            if ($order) {
                $order->order_status = $request->order_status;
                $order->save();
    
                // Update order items if order exists
                $updatedItems = OrderItem::where('order_id', $orderId)
                                ->update(['order_status' => $request->order_status]);
    
                DB::commit();
                return redirect()->route('ordersdash.index')->with('success', 'Order status updated successfully.');
            } else {
                DB::rollBack();
                return redirect()->route('ordersdash.index')->with('error', 'Order not found.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('ordersdash.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    

    /**
     * Update the status of a soft-deleted order.
     */
  

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
