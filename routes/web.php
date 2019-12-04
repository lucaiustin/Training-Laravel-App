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
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {

    if (!$request->session()->has('products_ids')) {
        $request->session()->put('products_ids', []);
    }

    $sessionProductsIds = session('products_ids');

    $products = Product::whereNotIn('id', $sessionProductsIds)->get();

    return view('index', ['products' => $products]);
});

Route::get('/cart', 'CartController@index');
Route::get('/cart/add/{id}', 'CartController@add');
Route::get('/cart/remove/{id}', 'CartController@remove');
Route::post('/mail', 'CartMailController@sendMail');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/products', 'ProductController');

Auth::routes();

