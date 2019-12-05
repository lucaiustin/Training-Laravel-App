@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/products/{{  $product->id }}">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <input type="text" class="input" name="title" placeholder="{{__('Title')}}}" value="{{  $product->title }}" required>
            <input type="text" class="input" name="price" placeholder="{{__('Price')}}" value="{{  $product->price }}" required>
            <input type="text" class="input" name="image_name" placeholder="{{__('Image Name')}}" value="{{  $product->image_name }}" required>
            <textarea name="description" class="textarea" required>{{ $product->description  }}</textarea>
            <button type="submit">{{__('Update Product')}}</button>
        </form>

        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endsection
