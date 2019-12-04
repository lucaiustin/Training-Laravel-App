@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($products as $product)
            <div>
                <p>This is product {{ $product->id }}</p>
                <p>{{ $product->title }}</p>
                <p>{{ $product->description }}</p>
                <p>{{ $product->price }}</p>
                <a href="/cart/remove/{{$product->id}}">Remove</a>
            </div>
            <hr>
        @endforeach
    </div>
    <a href="/">Index</a>
@endsection
