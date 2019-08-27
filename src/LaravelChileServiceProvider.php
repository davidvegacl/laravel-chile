<?php

namespace DavidVegaCl\LaravelChile;

use Validator;
use DavidVegaCl\LaravelChile\Rut;
use Illuminate\Support\ServiceProvider;
use DavidVegaCl\LaravelChile\Console\Commands\RegionesComunasSeeder;

class LaravelChileServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravelchile.php', 'laravelchile');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/laravelchile.php' => config_path('laravelchile.php'),
        ], 'laravelchile');

        $this->commands([
            RegionesComunasSeeder::class,
        ]);

        Validator::extend('rut', function ($attribute, $value, $parameters, $validator) {
            $validator->addReplacer('rut', function ($message, $attribute, $rule, $parameters) {
                return str_replace(':attribute', $attribute, $message == 'validation.rut'
                    ? 'El campo :attribute no es válido.'
                    : $message);
            });
            return Rut::parse($value)->isValid();
        });
        app()->bind('rut', function () {
            return new Rut;
        });

    }
}
