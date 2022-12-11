<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Interfaces\AuthInterface' ,
            'App\Http\Repositories\AuthRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\ProductsInterface' ,
            'App\Http\Repositories\ProductsRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\CartInterface' ,
            'App\Http\Repositories\CartRepository'
        );

        $this->app->bind(
            'App\Http\Interfaces\OrdersInterface' ,
            'App\Http\Repositories\OrdersRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
