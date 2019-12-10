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

        <a href="/">{{__('Go to index')}}</a>

        <form method="POST">
            {{ csrf_field() }}
            <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required>
            @error('title')
                {{ $message }}
            @enderror
            <br>
            <input type="text" name="contact_details" placeholder="{{ __('Contact Details') }}" value="{{ old('contact_details') }}" required>
            @error('contact_details')
            {{ $message }}
            @enderror
            <br>
            <textarea name="comments" } rows="10" cols="30" placeholder="{{__('Comments')}}" required>{{ old('comments') }}</textarea>
            @error('comments')
            {{ $message }}
            @enderror
            <br>
            <button type="submit">{{ __('Checkout') }}</button>
        </form>

        @if(session()->has('msg'))
            {{ session()->get('msg') }}
        @endif
    </div>
@endsection
