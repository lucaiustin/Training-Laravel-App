@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($orders as $order)
            @include('layouts.order')

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
