<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
        
        Paginator::defaultView('components.pagination');
        Blade::component('components.footer', 'footer');
        Blade::component('components.navigation', 'navigation');
        Blade::component('components.admin-navigation', 'admin-navigation');
    }
}
