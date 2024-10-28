<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price_per_unit' => $product->price,
                    'total_price' => $totalPrice,
                ]);

                $product->quantity -= $quantity;
                $product->save();
            }

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
        $orders = Order::onlyTrashed()->findOrFail($id);
        $orders->restore();

        return redirect()->route('ordersdash.trashed')->with('success', 'Orders restored successfully.');
    }

    public function forceDelete($id)
    {
        $orders = Order::onlyTrashed()->findOrFail($id);
        $orders->forceDelete();

        return redirect()->route('ordersdash.trashed')->with('success', 'Orders permanently deleted.');
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
