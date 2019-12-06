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
Route::get('/', 'ShopController@index')->middleware('auth');
Route::get('/{id}', 'ShopController@addToCart');

Route::post('/mail', 'CartMailController@sendMail');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/products', 'ProductController');
Route::resource('/orders', 'OrderController');


