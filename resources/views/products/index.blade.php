@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($products as $product)
            @include('layouts.product')

            <a href="/product/{{ $product->id }}">Edit</a>
            <form method="POST" action="/products/{{ $product->id }}">
                @method('DELETE')
                @csrf

                <button type="submit">{{ __('Delete Product') }}</button>
            </form>
            <hr>
        @endforeach

        <a href="/product">{{ __('Add') }}</a>

        <form id="frm-logout" action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
            <button type="submit">{{ __('Logout') }}</button>
        </form>
    </div>
@endsection
