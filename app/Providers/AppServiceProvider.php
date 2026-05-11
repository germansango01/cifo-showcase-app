<?php

namespace App\Providers;

use Faker\Factory as FakerFactory;
use Faker\Generator;
use Illuminate\Support\ServiceProvider;
use Spatie\Translatable\Facades\Translatable;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Generator::class, function () {
            return FakerFactory::create('es_ES');
        });
    }

    public function boot(): void
    {
        Translatable::fallback(
            fallbackLocale: 'es',
            fallbackAny: true,
        );
    }
}
