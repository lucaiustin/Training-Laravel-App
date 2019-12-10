@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($orders as $order)
                <p>{{ $order->created_at }}</p>
                <p>{{ $order->contact_details }}</p>
                <p>{{ $order->products->sum('price') }}</p>

            <a href="/order/{{ $order->id }}">{{ __('View Order') }}</a>
            <hr>
        @endforeach
    </div>
@endsection
