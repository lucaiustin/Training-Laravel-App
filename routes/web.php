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

use Illuminate\Http\Request;

Route::get('/spa', function () {
    return view('spa.spa');
});

Route::get('/vue', function () {
    return view('vue.index');
});

Route::get('/react', function () {
    return view('react.shop.index');
});

Route::get('/react/cart', function () {
    return view('react.shop.cart');
});

Route::get('/react/login', function () {
    return view('react.auth.index');
});

Route::get('/react/products', function () {
    return view('react.products.index');
});

Route::get('/react/product', function () {
    return view('react.products.form');
});

Route::get('/react/product/{id}', function () {
    return view('react.products.form');
});

Route::get('/react/orders', function () {
    return view('react.orders.index');
});

Route::get('/react/order/{id}', function () {
    return view('react.orders.show');
});

Route::get('/cart/{id}', 'ShopController@removeFromCart');
Route::get('/removeAllFromCart', 'ShopController@removeAllFromCart');
Route::get('/cart', 'ShopController@cart');
Route::post('/cart', 'ShopController@addNewOrder');

Route::get('/login', 'AuthController@login');
Route::post('/login', 'AuthController@login')->name('login');
Route::post('/logout', 'AuthController@logout')->name('logout')->middleware('auth');

Route::get('/products', 'ProductController@index');
Route::delete('/products/{id}', 'ProductController@destroy');
Route::get('/product', 'ProductController@create');
Route::post('/product', 'ProductController@store');
Route::get('/product/{id}', 'ProductController@edit');
Route::patch('/product/{id}', 'ProductController@update');

Route::get('/orders', 'OrderController@index');
Route::get('/order/{id}', 'OrderController@show');

Route::get('/', 'ShopController@index');
Route::get('/{id}', 'ShopController@addToCart');
