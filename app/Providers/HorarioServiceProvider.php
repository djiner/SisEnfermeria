<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HorarioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(HorarioServiceInterface::class, HorarioService::class);
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
