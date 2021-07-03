<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Inertia::share('flash', function() {
            return [
                'success' => session()->get('success'),
                'warning' => session()->get('warning'),
                'error' => session()->get('error'),
            ];
        });
        
        $this->publishes(
            [
                __DIR__ . '/pt_BR.json' => resource_path('lang/pt_BR.json'),
                __DIR__ . '/pt_BR' => resource_path('lang/pt_BR')
            ],
            'laravel-pt-br-localization'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::preventLazyLoading(! app()->isProduction());
    
        Paginator::useBootstrap();
    
        // Tradução de data Carbon - Está obtendo direto de config/app.php
        \Carbon\Carbon::setLocale($this->app->getLocale());
    }
}
