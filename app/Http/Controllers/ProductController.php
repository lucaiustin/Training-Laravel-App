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
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'price' => ['required', 'numeric']
        ]);
        $data['image_name'] = $request->file('image')->getClientOriginalName();

        Product::create($data);

        $request->file('image')->storeAs('images', $request->file('image')->getClientOriginalName());

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
        $product = Product::find($id);
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$this->authorize('edit', $product);
        $product = Product::find($id);
        return view('products.edit', ['product' => $product]);
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
        //$this->authorize('update', $product);
        $product = Product::find($id);

        $data = $request->validate([
            'title' => ['required', 'min:3'],
            'description' => 'required',
            'price' => ['required', 'numeric'],
            'image' => ['required', 'image']
        ]);

        $data['image_name'] = $request->file('image')->getClientOriginalName();

        $product->update($data);

        $request->file('image')->storeAs('images', $request->file('image')->getClientOriginalName());

        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$this->authorize('delete', $product);
        $product = Product::find($id);

        unlink(storage_path('app/public/images/'.$product->image_name));
        $product->delete();

        return redirect('/products');
    }
}
