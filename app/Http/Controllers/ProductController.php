<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::all();

        if ($request->ajax()) {
            return $products;
        }
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => ['required', 'min:3'],
            'description' => 'required',
            'price' => ['required', 'numeric'],
            'image' => ['required', 'image']
        ]);

        $image_path = $request->file('image')->store('images');
        $image_name = basename($image_path);

        $data['image_name'] = $image_name;
        Product::create($data);

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($request->ajax()) {
            return $product;
        }
        return view('products.form', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'title' => ['required', 'min:3'],
            'description' => 'required',
            'price' => ['required', 'numeric'],
            'image' => ['required', 'image']
        ]);

        unlink(storage_path('app/public/images/'.$product->image_name));

        $image_path = $request->file('image')->store('images');
        $image_name = basename($image_path);

        $data['image_name'] = $image_name;

        $product->update($data);

        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        unlink(storage_path('app/public/images/'.$product->image_name));
        $product->delete();

        if ($request->ajax()) {
            $products = Product::all();
            return $products;
        }
        return redirect('/products');
    }
}
