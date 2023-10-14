<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('no_repeated_chars', function ($attribute, $value, $parameters, $validator) {
            return !preg_match('/(.)\1{2,}/', $value); // Esta expresión regular verifica si hay tres o más caracteres repetidos.
        });
    }
}
