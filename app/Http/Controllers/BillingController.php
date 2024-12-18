<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Billing;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Mail\BillingDetailsEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;  

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
    public function store(Request $request, $orderId = null)
    {
        $user = Auth::user();

        // Log the received order ID
        Log::info('Received Order ID: ' . $orderId);

        // Fallback: fetch the latest order if orderId is null or invalid
        if (!$orderId) {
            $order = $user->orders()->latest()->first();
            $orderId = $order ? $order->id : null;
        }

        // Check if the order exists in the database
        $orderToUpdate = Order::find($orderId);
        if (!$orderToUpdate) {
            Log::error('Order not found for ID: ' . $orderId);
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }

        // Fetch order items for the user
        $orders = $user->orders()->with('product')->get();
        if ($orders->isEmpty()) {
            return redirect()->route('orders.index')->with('error', 'Your cart is empty.');
        }

        // Validate billing details
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'billing_city' => 'required|string',
            'billing_address' => 'required|string',
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
            $billing->order_id = $orderId;
            $billing->save();

            // Process each order item
            foreach ($orders as $order) {
                $product = $order->product;
                if (!$product) {
                    DB::rollBack();
                    Log::error('Product not found for order ID: ' . $order->id);
                    return redirect()->route('orders.index')->with('error', 'Product not found for order: ' . $order->id);
                }

                if ($product->quantity < $order->quantity) {
                    DB::rollBack();
                    Log::error('Not enough stock for ' . $product->name);
                    return redirect()->route('orders.index')->with('error', 'Not enough stock for ' . $product->name);
                }

                // Save order item details
                $orderItem = new OrderItem();
                $orderItem->user_id = $user->id;
                $orderItem->product_id = $product->id;
                $orderItem->order_id = $orderId;
                $orderItem->quantity = $order->quantity;
                $orderItem->price_per_unit = $product->price;
                $orderItem->total_price = $product->price * $order->quantity;
                $orderItem->order_status = 'processing';
                $orderItem->save();

                // Update product stock
                $product->quantity -= $order->quantity;

                // Check if stock is now zero
                if ($product->quantity <= 0) {
                    $product->stock = 'out_of_stock'; // Assuming 'stock' is the column name for the status
                }

                $product->save();

                // Delete processed order
                $order->delete();
            }

            // Update order status to "processing"
            $orderToUpdate->order_status = 'processing';
            $orderToUpdate->save();
            Log::info('Order Status Updated to Processing for Order ID: ' . $orderId);

            // Create a single notification after the checkout process
            Notification::create([
                'user_id' => $user->id, // Use the authenticated user's ID
                'type' => 'New Order', // Type of notification
                'data' => json_encode([
                    'message' => 'A new order has been placed successfully!',
                    'order_id' => $orderId, // Order ID
                    'user_name' => $user->first_name . ' ' . $user->last_name, // User's full name
                    'user_email' => $user->email, // User's email
                    'user_image' => $user->image ? asset('storage/' . $user->image) : asset('assets/img/default-avatar.png'), // User's image URL
                ]), // Notification message and order ID
                'is_read' => false, // Set as unread
            ]);

            DB::commit();

            // Send billing details email
            Mail::to($user->email)->send(new BillingDetailsEmail($billing, $orders));

            return redirect()->route('orders.index')->with('success', 'Checkout completed successfully. Billing details saved. Check your email for details.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Error: ' . $e->getMessage());
            return redirect()->route('orders.index')->with('error', 'An error occurred during checkout. Please try again.');
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
