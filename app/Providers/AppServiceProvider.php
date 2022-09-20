<?php

namespace App\Providers;

use Illuminate\Config\Repository;
use Illuminate\Support\ServiceProvider;
use Illuminatech\Config\PersistentRepository;
use Illuminatech\Config\StorageDb;
// use Laravel\Telescope\TelescopeApplicationServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            // if (class_exists(TelescopeApplicationServiceProvider::class)) {
            //     $this->app->register(TelescopeServiceProvider::class);
            // }
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->extend('config', function (Repository $originConfig) {
            $storage = new StorageDb($this->app->make('db.connection'));

            return (new PersistentRepository($originConfig, $storage));
        });

        // ...
    }
}
