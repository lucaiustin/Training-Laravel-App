@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/products/{{  $product->id }}" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <p><input type="text" class="input" name="title" placeholder="{{ __('Title') }}" value="{{  $product->title }}" required></p>
            <p><input type="text" class="input" name="price" placeholder="{{ __('Price') }}" value="{{  $product->price }}" required></p>
            <p><textarea name="description" class="textarea" required>{{ $product->description  }}</textarea></p>
            <p><input type="file" name="image" /></p>
            <p><button type="submit">{{ __('Update Product') }}</button></p>
        </form>

        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endsection
