<?php

namespace App\Providers;

use Faker\Factory as FakerFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(\Faker\Generator::class, function () {
            return FakerFactory::create('es_ES');
        });
    }

    public function boot(): void
    {
    }
}
