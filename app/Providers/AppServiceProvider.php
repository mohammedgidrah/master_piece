<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Notification;
use App\View\Components\InputError;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Share notifications with the dashboard navbar view
        View::composer('dashboard.navbar', function ($view) {
            // You can limit notifications here if necessary
            $view->with('notifications', Notification::all());
        });

        // Share cart count and orders with the homepage navbar view and all views globally
        View::composer('homepage.homenav.homenav', function ($view) {
            $cartCount = auth()->check() ? Order::where('customer_id', auth()->id())->count() : 0;

            // Get orders for the cart total calculation
            $orders = auth()->check()
                ? Order::with('product')->where('customer_id', auth()->id())->get()
                : collect();

            // Calculate the total cart amount
            $cartTotal = $orders->sum(function ($order) {
                return $order->product->price * $order->quantity;
            });

            // Pass the necessary data to the view
            $view->with([
                'cartCount' => $cartCount,
                'orders' => $orders,
                'cartTotal' => $cartTotal,
                'user' => auth()->user(),
            ]);
        });

        // Register custom Blade components
        Blade::component('input-error', InputError::class);
    }
}
