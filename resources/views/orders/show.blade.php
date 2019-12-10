@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            {{ $order->name }}
            <br>
            {{ $order->contact_details }}
            <br>
            {{ $order->comments }}
            <br>
            {{ $order->products->sum('price') }}
            <br>
            {{ $order->created_at }}
            <br><br>
            @foreach ($order->products as $product)
                @include('layouts.product')
            @endforeach
        </div>
    </div>
@endsection
