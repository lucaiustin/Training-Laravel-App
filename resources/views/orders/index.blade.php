@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($orders as $order)
            @include('layouts.order')
            <a href="/order/{{ $order->id }}">View</a>
            <hr>
        @endforeach
    </div>
@endsection
