@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <p>{{ __('This is order') }} {{ $order->id }}</p>
            <p>{{ $order->name }}</p>
            <p>{{ $order->contact_details }}</p>
            <p>{{ $order->products->sum('price') }}</p>

            @foreach ($order->products as $product)
                <div>
                    <p>This is product {{ $product->id }}</p>
                    <img src="{{ url('storage/', $product->image_name) }}">
                    <p>{{ $product->title }}</p>
                    <p>{{ $product->description }}</p>
                    <p>{{ $product->price }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
