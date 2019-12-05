@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($products as $product)
            @include('layouts.product')

            <form method="POST" action="/products/{{ $product->id }}">
                @method('DELETE')
                @csrf

                <button type="submit">{{ __('Delete Product') }}</button>
            </form>
            <a href="/products/{{ $product->id }}/edit">Edit</a>
            <hr>
        @endforeach

        <a href="/products/create">{{ __('Add') }}</a>
        <a href="/cart">{{ __('Cart') }}</a>

        <form id="frm-logout" action="{{ route('logout') }}" method="POST">
            {{ csrf_field() }}
            <button type="submit">{{ __('Logout') }}</button>
        </form>
    </div>
@endsection
