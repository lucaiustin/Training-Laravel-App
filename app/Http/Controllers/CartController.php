<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $sessionProductsIds = session('products_ids');
        $products = Product::whereIn('id', $sessionProductsIds)->get();

        return view('cart.index', ['products' => $products]);
    }

    public function add($id)
    {
        session()->push('products_ids', $id);
        return redirect('/');
    }

    public function remove($id)
    {
        $products_ids = session()->pull('products_ids', []);
        if(($key = array_search($id, $products_ids)) !== false) {
            unset($products_ids[$key]);
        }
        session()->put('products_ids', $products_ids);
        return redirect('/cart');
    }
}
