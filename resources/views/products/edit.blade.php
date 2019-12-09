@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/product/{{  $product->id }}" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            <p><input type="text" name="title" placeholder="{{ __('Title') }}" value="{{  $product->title }}" required></p>
            <p><input type="text" name="price" placeholder="{{ __('Price') }}" value="{{  $product->price }}" required></p>
            <p><textarea name="description" required>{{ $product->description  }}</textarea></p>
            <p><input type="text" name="image_name" placeholder="{{ __('Image Name') }}" value="{{  $product->image_name }}" required></p>
            <p><input type="file" name="image" /></p>
            <p><button type="submit">{{ __('Update Product') }}</button></p>
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
    </div>
@endsection
