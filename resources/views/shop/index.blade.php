@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($products as $product)
            <div>
                @include('layouts.product')

                <a href="/{{ $product->id }}">{{ __('Add') }}</a>
            </div>
            <hr>
        @endforeach
        <a href="/cart">{{ __('Cart') }}</a>
    </div>
@endsection
