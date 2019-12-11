@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/product/{{  $product->id }}" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            <input type="text" name="title" placeholder="{{ __('Title') }}" value="{{  $product->title }}" required>
            @error('title')
            {{ $message }}
            @enderror
            <br>
            <input type="text" name="description"  placeholder="{{ __('Description') }}" value="{{  $product->description }}" required>
            @error('description')
            {{ $message }}
            @enderror
            <br>
            <input type="text" name="price" placeholder="{{ __('Price') }}" value="{{  $product->price }}" required>
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
        <a href="/products">Products</a>
    </div>
@endsection
