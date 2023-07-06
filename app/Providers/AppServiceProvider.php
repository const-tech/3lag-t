<?php

namespace App\Providers;

use App\Models\Invoice;
use App\Observers\InvoiceObserve;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->type == 'admin';
        });
        Blade::if('dr', function () {
            return auth()->check() && auth()->user()->type == 'dr';
        });
        Blade::if('recep', function () {
            return auth()->check() && auth()->user()->type == 'recep';
        });
        Blade::if('lab', function () {
            return auth()->check() && auth()->user()->type == 'lab';
        });
        Blade::if('scan', function () {
            return auth()->check() && auth()->user()->type == 'scan';
        });

        // observers
        Invoice::observe(InvoiceObserve::class);
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();
        Debugbar::disable();
    }
}
