<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/categories', 'CategoriesController@index')->name('categories');
Route::get('/categories/{id}', 'CategoriesController@detail')->name('category-detail');

Route::get('/details/{id}', 'DetailController@index')->name('product-detail-user');
Route::post('/details/{id}', 'DetailController@add')->name('product-detail-add');

Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');

Route::get('/success', 'CartController@success')->name('success');
Route::get('/register-success', 'Auth\RegisterController@success')->name('register-success');

Route::get('/auth/{provider}', 'Auth\SocialiteController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\SocialiteController@handleProviderCallback');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::delete('/cart/{id}', 'CartController@deleteCart')->name('delete-cart');
    Route::post('/checkout', 'CheckoutController@proccess')->name('checkout');

    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');

    Route::get('/dashboard-product', 'Admin\ProductController@index')->name('dashboard-product');
    Route::get('/dashboard-product/product/{id}', 'Admin\ProductController@deleteProduct')->name('dashboard-delete-products');
    Route::get('/dashboard-product-create', 'Admin\ProductController@create')->name('dashboard-products-create');
    Route::post('/dashboard-product-create', 'Admin\ProductController@store')->name('dashboard-products-store');
    Route::get('/dashboard-product/detail/{id}', 'Admin\ProductController@details')->name('dashboard-products-details');
    Route::put('/dashboard-product/product/{id}', 'Admin\ProductController@update')->name('dashboard-products-update');
    Route::post('/dashboard-product/product-upload-gallery', 'Admin\ProductController@uploadGallery')->name('dashboard-products-upload-gallery');
    Route::get('/dashboard-product/product-galleries/{id}', 'Admin\ProductController@deleteGallery')->name('dashboard-products-delete-gallery');

    Route::get('/dashboard-transactions', 'Admin\TransactionsController@index')->name('dashboard-transactions');
    Route::get('/dashboard-transactions/{id}', 'Admin\TransactionsController@details')->name('dashboard-transactions-details');
    Route::post('/dashboard-transactions/{id}', 'Admin\TransactionsController@update')->name('dashboard-transactions-update');

    Route::get('/dashboard-setting-store', 'Admin\SettingController@store')->name('dashboard-setting-store');
    Route::get('/dashboard-setting-account', 'Admin\SettingController@account')->name('dashboard-setting-account');
    Route::post('/dashboard-setting-store/update/{request}', 'Admin\SettingController@update')->name('dashboard-setting-update');
});

// Super Admin
Route::prefix('SuperAdmin')
    ->namespace('SuperAdmin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard-admin');
        Route::resource('category', 'CategoryController');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-gallery', 'ProductGalleryController');
    });


Auth::routes();


// Route::get('/debug-sentry', function () {
//     throw new Exception('My first Sentry error!');
// });
