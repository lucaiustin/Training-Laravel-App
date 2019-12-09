@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($products as $product)
            <div>
                @include('layouts.product')
                <a href="/cart/{{$product->id}}">{{__('Remove')}}</a>
            </div>
            <hr>
        @endforeach
    </div>
    <a href="/">{{__('Index')}}</a>

    <form method="POST" action="/orders">
        {{ csrf_field() }}
        <ul>
            <li><input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required></li>
            <li><textarea name="contact_details" } placeholder="{{__('Contact Details')}}" required>{{ old('contact_details') }}</textarea></li>
            <li><textarea name="comments" } placeholder="{{__('Comments')}}" required>{{ old('comments') }}</textarea></li>
            <li><button type="submit">{{ __('Checkout') }}</button></li>
        </ul>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
