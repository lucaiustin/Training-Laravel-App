@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <p>{{ __('This is order') }} {{ $order->id }}</p>
            <p>{{ $order->name }}</p>
            <p>{{ $order->contact_details }}</p>
            <p>{{ $order->products->sum('price') }}</p>

            @foreach ($order->products as $product)
                @include('layouts.product')
            @endforeach
        </div>
    </div>
@endsection
