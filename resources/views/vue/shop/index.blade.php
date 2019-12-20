@extends('layouts.app')

@section('content')
    <div id="app">
        <div class="container">
            <not-in-cart-products></not-in-cart-products>
            <a href="/vue/cart">{{ __('Go to cart') }}</a>
        </div>
    </div>
@endsection
