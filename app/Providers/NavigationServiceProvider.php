<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Service;

class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('layouts.navigation', function ($view) {
            $services = Service::all(); 
            $view->with('services', $services);
        });
    }
}
