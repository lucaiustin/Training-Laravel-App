@extends('layouts.app')

@section('content')
    <div class="container">
        <cart-products></cart-products>

        <a href="/vue">{{__('Go to index')}}</a>


    </div>
@endsection
