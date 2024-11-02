<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\InputError;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
 

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
        Blade::component('input-error', InputError::class);
    }
}
