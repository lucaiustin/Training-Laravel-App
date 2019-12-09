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

Route::get('/cart/{id}', 'ShopController@removeFromCart');
Route::get('/cart', 'ShopController@cart');

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
Route::post('/orders', 'OrderController@store');
Route::get('/order/{id}', 'OrderController@show');

Route::get('/', 'ShopController@index')->middleware('auth');
Route::get('/{id}', 'ShopController@addToCart');


