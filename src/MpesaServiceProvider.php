<?php

namespace Frena\Mpesa;

use Frena\Mpesa\Helpers\MpesaResponse;
use Frena\Mpesa\Services\MpesaService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class MpesaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('mpesa', function() {
            return new MpesaService;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/mpesa.php' => config_path('mpesa.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/config/mpesa.php', 'mpesa'
        );
    
    }
}
