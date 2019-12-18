<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Order;


class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index', 'show', 'edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = DB::table('orders')
            ->join('order_product', 'orders.id', '=', 'order_product.order_id')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->select('orders.*', DB::raw('sum(products.price) as prices_sum'))
            ->groupBy('orders.id')
            ->get();

        if ($request->ajax()) {
            return $orders;
        }
        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($request->ajax()) {
            return response()->json([
                'order' => $order,
                'products' => $order->products
            ]);
        }
        return view('orders.show', ['order' => $order]);
    }
}
