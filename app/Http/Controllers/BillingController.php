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
     */

     public function store(Request $request)
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
             'user_id' => 'required|integer',
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
             $billing->order_id = $request->order_id;
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
     
                 $currentStock = (int) $product->quantity;
                 $newStock = $currentStock - $order->quantity;
     
                 if ($newStock < 0) {
                     DB::rollBack();
                     Log::error('Checkout Error: Not enough stock for ' . $product->name);
                     return redirect()->route('orders.index')->with('error', 'Not enough stock for ' . $product->name);
                 }
             }
     
             // Save product IDs and order IDs in OrderItem table
             foreach ($orders as $order) {
                // Save each product and order association in the OrderItem table
                $orderItem = new OrderItem(); // Make sure to use the correct namespace for OrderItem
                $orderItem->product_id = $order->product->id; // Assuming `product` relationship exists
                $orderItem->order_id = $request->order_id; // The order ID from the billing form
                $orderItem->quantity = $order->quantity; // Store the quantity
                $orderItem->price_per_unit = $order->product->price; // Set the price per unit
                $orderItem->total_price = $order->product->price * $order->quantity; // Calculate total price
                $orderItem->save();
            
                // Update product stock
                $product = $order->product;
                $product->quantity -= $order->quantity;
                $product->save();
            
                // Delete the order after processing
                $order->delete();
            }
            
     
             DB::commit();
     
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
