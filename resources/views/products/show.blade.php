@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            @include('layouts.product')

            <a href="/product/{{ $product->id }}/edit">{{ __('Edit') }}</a>
        </div>

        <hr>
        <a href="/cart">{{ __('Cart') }}</a>
    </div>
@endsection
