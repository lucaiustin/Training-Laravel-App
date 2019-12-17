<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Product;
use App\Models\Order;
use App\Mail\CartMail;
use Illuminate\Http\Response;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $sessionProductsIds =  $request->session()->get('products_ids', []);
        $products = Product::whereNotIn('id', $sessionProductsIds)->get();

        if ($request->ajax()) {
            return $products;
        }

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

        if ($request->ajax()) {
            return $products;
        }

        return view('shop.cart', ['products' => $products]);
    }

    public function addNewOrder(Request $request)
    {
        $sessionProductsIds = session('products_ids');
        $products = Product::whereIn('id', $sessionProductsIds)->get();

        if (count($products) < 1) {
            if ($request->ajax()) {
                return response()->json(['msg'=>'There are not enough products!']);
            } else {
                return back()->with('msg', 'There are not enough products!');
            }
        }

        $data = $request->validate([
            'name' => ['required', 'max:255'],
            'contact_details' => 'required',
            'comments' => 'required',
        ]);
        $data['created_at'] = date('Y-m-d H:i:s');

        $order = Order::create($data);
        $order->products()->attach($products);

        try {
            Mail::to(config('constants.send_mail_to'))->send(new CartMail($order));
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['msg'=>'Unable to send email. Please try again.']);
            } else {
                return back()->with('msg', 'Unable to send email. Please try again.');
            }
        }
        if ($request->ajax()) {
            return response()->json(['msg'=>'Your mail has been sent successfully. The order has been created.']);
        } else {
            return back()->with('msg', 'Your mail has been sent successfully. The order has been created.');
        }
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
