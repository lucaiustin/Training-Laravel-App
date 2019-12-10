@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="product-list">
            @foreach ($products as $product)
                @include('layouts.product')
                <a href="/{{ $product->id }}">{{ __('Add') }}</a>
                <hr>
            @endforeach
        </div>
        <a href="/cart">{{ __('Go to cart') }}</a>
    </div>
@endsection

