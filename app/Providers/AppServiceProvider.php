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
            $view->with('notifications', Notification::all());
        });

        // Share orders and cart count with the homepage navbar and all views globally
        View::composer('*', function ($view) {
            $orders = auth()->check()
                ? Order::with('product')->where('customer_id', auth()->id())->get()
                : collect();

            $cartCount = $orders->count();
            $cartTotal = $orders->sum(function ($order) {
                return $order->product->price * $order->quantity;
            });

            $view->with([
                'orders' => $orders,
                'cartCount' => $cartCount,
                'cartTotal' => $cartTotal,
                'user' => auth()->user(),
            ]);
        });

        // Register custom Blade components
        Blade::component('input-error', InputError::class);
    }
}
