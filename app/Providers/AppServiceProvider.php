<?php

namespace App\Providers;

use Illuminate\View\View;

use App\Models\ProductCart;
use Illuminate\Pagination\Paginator;
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
    public function boot(): void
    {
        //
        view()->composer('*', function (View $view) {
            $cartTotal = ProductCart::where('user_id', auth()->id())->count();
            $view->with('cartTotal', $cartTotal);
        });

        Paginator::useBootstrap();
    }
}
