@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($products as $product)
            <div>
                <p>This is product {{ $product->id }}</p>
                <p>{{ $product->title }}</p>
                <p>{{ $product->description }}</p>
                <p>{{ $product->price }}</p>
            </div>
            <form method="POST" action="/products/{{  $product->id }}">
                @method('DELETE')
                @csrf

                <button type="submit">Delete Product</button>
            </form>
            <hr>
        @endforeach
        <a href="/products/create">Add</a>
        <a href="/cart">Cart</a>
    </div>
@endsection
