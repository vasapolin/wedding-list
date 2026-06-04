<?php

namespace App\Providers;

use App\Services\Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Cart::class);
    }

    public function boot(): void
    {
        View::composer('*', function ($view): void {
            $view->with('cart', app(Cart::class));
        });
    }
}
