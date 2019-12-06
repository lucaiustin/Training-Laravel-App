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
        <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required>
        <textarea name="contact_details" } value="{{ old('contact_details') }}" required>{{ __('Contact Details') }}</textarea>
        <textarea name="comments" }  value="{{ old('comments') }}" required>{{ __('Comments') }}</textarea>
        <button type="submit">{{ __('Checkout') }}</button>
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
