@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset($product))
            <form method="POST" action="/product/{{  $product->id }}" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
        @else
            <form method="POST" action="/product" enctype="multipart/form-data">
            {{ csrf_field()  }}
        @endif

            <input type="text" name="title" placeholder="{{ __('Title') }}" value="{{ (isset($product->title) ? old('title', $product->title) : old('title')) }}" required>
            @error('title')
            {{ $message }}
            @enderror
            <br>
            <input type="text" name="description" placeholder="{{ __('Description') }}" value="{{ (isset($product->description) ? old('description', $product->description) : old('description')) }}" required>
            @error('description')
            {{ $message }}
            @enderror
            <br>
            <input type="text" name="price" placeholder="{{ __('Price') }}" value="{{ (isset($product->price) ?  old('price', $product->price) : old('price')) }}" required>
            @error('price')
            {{ $message }}
            @enderror
            <br>
            <input type="file" name="image" />
            @error('image')
            {{ $message }}
            @enderror
            <br>
            <button type="submit">{{ __('Save') }}</button>
        </form>
        <br>
        <a href="/products">{{ __('Products') }}</a>
    </div>
@endsection
