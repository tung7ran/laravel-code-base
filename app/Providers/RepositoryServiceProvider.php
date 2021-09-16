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
        $this->app->bind(\App\Repositories\PagesRepository::class, \App\Repositories\PagesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PostCategoryPostRepository::class, \App\Repositories\PostCategoryPostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PostCategoryPostRepository::class, \App\Repositories\PostCategoryPostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Post\CategoryPostRepository::class, \App\Repositories\Post\CategoryPostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ContactRepository::class, \App\Repositories\ContactRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Contact\ContactRepository::class, \App\Repositories\Contact\ContactRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Customer\CustomerRepository::class, \App\Repositories\Customer\CustomerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Images\ImageRepository::class, \App\Repositories\Images\ImageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Menu\MenuRepository::class, \App\Repositories\Menu\MenuRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Orders\OrderRepository::class, \App\Repositories\Orders\OrderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Products\ProductRepository::class, \App\Repositories\Products\ProductRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Users\UserRepository::class, \App\Repositories\Users\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Post\PostRepository::class, \App\Repositories\Post\PostRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Policy\PolicyRepository::class, \App\Repositories\Policy\PolicyRepositoryEloquent::class);
        //:end-bindings:
    }
}
