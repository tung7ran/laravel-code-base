<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', 'IndexController@getHome')->name('home.index');
Route::group(['namespace' => 'Backend'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/home', 'HomeController@index')->name('admin.home');
        Route::resource('users', 'UserController', ['except' => ['show']]);
        Route::resource('image', 'ImageController', ['except' => ['show']]);
        Route::post('image/postMultiDel', ['as' => 'image.postMultiDel', 'uses' => 'ImageController@deleteMuti']);

        // Bài viết
        Route::resource('posts', 'PostsController');
        Route::post('posts/postMultiDel', ['as' => 'posts.postMultiDel', 'uses' => 'PostsController@deleteMuti']);

        // ngân hàng
        Route::resource('banks', 'BanksController');
        Route::post('banks/postMultiDel', ['as' => 'banks.postMultiDel', 'uses' => 'BanksController@deleteMuti']);

        // đơn hàng
        Route::resource('orders', 'OrdersController');
        Route::post('orders/postMultiDel', ['as' => 'orders.postMultiDel', 'uses' => 'OrdersController@deleteMuti']);
        Route::resource('pages', 'PagesController');
        Route::resource('options', 'OptionsController');
        Route::resource('menu', 'MenusController');

        // sản phẩm
        Route::resource('products', 'ProductsController', ['except' => ['show']]);
        Route::post('products/postMultiDel', ['as' => 'products.postMultiDel', 'uses' => 'ProductsController@deleteMuti']);
        Route::get('products/get-slug', 'ProductsController@getAjaxSlug')->name('products.get-slug');
        Route::resource('category', 'CategoryController', ['except' => ['show']]);
        Route::resource('policy', 'PoliciesController', ['except' => ['show']]);

        Route::get('/get-layout', 'HomeController@getLayOut')->name('get.layout');
    });
});
