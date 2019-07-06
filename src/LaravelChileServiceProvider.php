<?php

namespace DavidVegaCl\LaravelChile;

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

    }
}
