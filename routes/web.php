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

use App\Product;


Route::get('/', function () {
    $sessionProductsIds = session('products_ids');

    $products = Product::whereNotIn('id', $sessionProductsIds)->get();

    return view('index', ['products' => $products]);
});

Route::get('/cart', 'CartController@index');
Route::get('/cart/add/{id}', 'CartController@add');
Route::get('/cart/remove/{id}', 'CartController@remove');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
