@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($products as $product)
            <div>
                <p>This is product {{ $product->id }}</p>
                <p>{{ $product->title }}</p>
                <p>{{ $product->description }}</p>
                <p>{{ $product->price }}</p>
                <a href="/cart/add/{{$product->id}}">Add</a>
            </div>
            <hr>
        @endforeach
        <a href="/cart">Cart</a>
    </div>
@endsection
