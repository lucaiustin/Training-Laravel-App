@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <p>This is product {{ $product->id }}</p>
            <p>{{ $product->title }}</p>
            <p>{{ $product->description }}</p>
            <p>{{ $product->price }}</p>
            <a href="/product/{{$product->id}}/edit">Edit</a>
        </div>

        <hr>
        <a href="/cart">Cart</a>
    </div>
@endsection
