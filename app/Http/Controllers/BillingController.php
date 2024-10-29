<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Billing;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Mail\BillingDetailsEmail; // Import the new mail class
use Illuminate\Support\Facades\Mail; // Import Mail facade

class BillingController extends Controller
{
    /**
     * Show the billing form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $user = Auth::user();

        $order = Order::where('customer_id', $user->id)->latest()->first();

        $orderId = $order ? $order->id : null;

        return view('homepage.bilings.bilingform', compact('orderId', 'user'));
    }

    public function showBillingForm($orderId)
    {
        $order = Order::find($orderId);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        $user = auth()->user();

        return view('homepage.bilings.bilingform', compact('order', 'user'));
    }

    /**
     * Handle the form submission and store billing details.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */public function store(Request $request)
{
    $user = Auth::user();

    // Retrieve the user's orders
    $orders = $user->orders()->with('product')->get();

    if ($orders->isEmpty()) {
        return redirect()->route('orders.index')->with('error', 'Your cart is empty.');
    }

    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string',
        'billing_city' => 'required|string',
        'billing_address' => 'required|string',
        'order_id' => 'required|integer',
    ]);

    DB::beginTransaction();

    try {
        // Save billing details
        $billing = new Billing();
        $billing->user_id = $user->id;
        $billing->first_name = $request->first_name;
        $billing->last_name = $request->last_name;
        $billing->email = $request->email;
        $billing->phone = $request->phone;
        $billing->billing_city = $request->billing_city;
        $billing->billing_address = $request->billing_address;
        $billing->order_id = $request->order_id; // Associate the order ID
        $billing->save();

        // Calculate total amount and check stock
        $total = $orders->sum(function ($order) {
            return $order->product->price * $order->quantity;
        });

        foreach ($orders as $order) {
            $product = $order->product;

            if (!$product) {
                DB::rollBack();
                Log::error('Checkout Error: Product not found for order ID: ' . $order->id);
                return redirect()->route('orders.index')->with('error', 'Product not found for order: ' . $order->id);
            }

            $currentStock = (int)$product->quantity;
            $newStock = $currentStock - $order->quantity;

            if ($newStock < 0) {
                DB::rollBack();
                Log::error('Checkout Error: Not enough stock for ' . $product->name);
                return redirect()->route('orders.index')->with('error', 'Not enough stock for ' . $product->name);
            }

            // Save product IDs and order IDs in OrderItem table
            $orderItem = new OrderItem();
            $orderItem->user_id = $user->id;
            $orderItem->product_id = $product->id;
            $orderItem->order_id = $request->order_id;
            $orderItem->quantity = $order->quantity;
            $orderItem->price_per_unit = $product->price;
            $orderItem->total_price = $product->price * $order->quantity;
            $orderItem->save();

            // Update product stock
            $product->quantity -= $order->quantity;
            $product->save();

            // Delete the order after processing
            $order->delete();
        }

        // Update order status from 'pending' to 'processing'
        $orderToUpdate = Orderitem::find($request->order_id);
        if ($orderToUpdate) {
            Log::info('Order Status Update Attempted for Order ID: ' . $request->order_id);
            Log::info('Current Status - ' . $orderToUpdate->order_status);
            
            if ($orderToUpdate->order_status === 'pending') {
                $orderToUpdate->order_status = 'processing';
                $orderToUpdate->save();
                Log::info('Order Status Updated: New Status - ' . $orderToUpdate->order_status);
            } else {
                Log::info('Order Status Not Updated: Status is already - ' . $orderToUpdate->order_status);
            }
        } else {
            Log::error('Order not found for ID: ' . $request->order_id);
        }

        DB::commit();
        Mail::to($user->email)->send(new BillingDetailsEmail($billing, $orders));

        return redirect()->route('orders.index')->with('success', 'Checkout completed successfully. Billing details saved.');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Checkout Error: ' . $e->getMessage());
        return redirect()->route('orders.index')->with('error', 'An error occurred during checkout. Please try again. Details: ' . $e->getMessage());
    }
}

    
    
     
     

    public function showCheckoutForm()
    {

        $billingDetails = session('billing_details');
        $orderId = session('order_id');
        $userId = session('user_id');

        $order = Order::find($orderId);

        $user = auth()->user();

        return view('homepage.bilings.bilingform', compact('billingDetails', 'order', 'userId', 'user'));
    }

}
