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
        View::composer('dashboard.navbar', function ($view) {
            $view->with('notifications', Notification::all());
        });

        View::composer('homepage.homenav.homenav', function ($view) {
            $cartCount = auth()->check() ? Order::where('customer_id', auth()->id())->count() : 0;
            $view->with('cartCount', $cartCount);
        });
        Blade::component('input-error', InputError::class);
    }
}
