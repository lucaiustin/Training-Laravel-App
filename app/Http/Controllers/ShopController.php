<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $sessionProductsIds =  $request->session()->get('products_ids', []);
        $products = Product::whereNotIn('id', $sessionProductsIds)->get();

        return view('shop.index', ['products' => $products]);
    }

    public function addToCart($id)
    {
        session()->push('products_ids', $id);
        return redirect('/');
    }

    public function cart(Request $request)
    {
        $sessionProductsIds = $request->session()->get('products_ids', []);
        $products = Product::whereIn('id', $sessionProductsIds)->get();

        return view('shop.cart', ['products' => $products]);
    }

    public function removeFromCart(Request $request, $id)
    {
        $products_ids = $request->session()->get('products_ids', []);
        if(($key = array_search($id, $products_ids)) !== false) {
            unset($products_ids[$key]);
        }
        session()->put('products_ids', $products_ids);
        return redirect('/cart');
    }
}
