@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($products as $product)
            <div>
                <p>{{ __('This is product') }} {{ $product->id }}</p>
                <img src="{{ url('storage/', $product->image_name) }}">
                <p>{{ $product->title }}</p>
                <p>{{ $product->description }}</p>
                <p>{{ $product->price }}</p>
                <a href="/cart/add/{{ $product->id }}">Add</a>
            </div>
            <hr>
        @endforeach
        <a href="/cart">{{ __('Cart') }}</a>
    </div>
@endsection
