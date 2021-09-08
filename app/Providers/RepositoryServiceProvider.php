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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\Finace\BanksRepository::class, \App\Repositories\Finace\BanksRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Post\CategoryRepository::class, \App\Repositories\Post\CategoryRepositoryEloquent::class);
        //:end-bindings:
    }
}
