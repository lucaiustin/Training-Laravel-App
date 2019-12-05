@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($orders as $order)
            <div>
                <p>{{ __('This is order') }} {{ $order->id }}</p>
                <p>{{ $order->name }}</p>
                <p>{{ $order->contact_details }}</p>
                <p>{{ $order->products->sum('price') }}</p>
            </div>
            <a href="/orders/{{ $order->id }}">View</a>
            <a  href="/orders/{{ $order->id }}/edit">Edit</a>
            <form method="POST" action="/orders/{{ $order->id }}">
                @method('DELETE')
                @csrf

                <button type="submit">{{ __('Delete Order') }}</button>
            </form>
            <hr>
        @endforeach
    </div>
@endsection
