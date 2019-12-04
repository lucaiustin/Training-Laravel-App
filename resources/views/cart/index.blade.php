@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($products as $product)
            <div>
                <p>This is product {{ $product->id }}</p>
                <p>{{ $product->title }}</p>
                <p>{{ $product->description }}</p>
                <p>{{ $product->price }}</p>
                <a href="/cart/remove/{{$product->id}}">Remove</a>
            </div>
            <hr>
        @endforeach
    </div>
    <a href="/">Index</a>

    <form method="POST" action="/mail">
        {{ csrf_field() }}
        <input type="text" name="name" placeholder="Name">
        <textarea name="contact_details" }>Contact Details</textarea>
        <textarea name="comments" }>Comments</textarea>
        <button type="submit">Checkout</button>
    </form>
@endsection
