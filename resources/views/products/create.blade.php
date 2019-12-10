@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/product" enctype="multipart/form-data">
            {{ csrf_field()  }}

            <input type="text" name="title" placeholder="{{ __('Title') }}" value="{{ old('title') }}" required>
            @error('title')
            {{ $message }}
            @enderror
            <br>
            <input type="text" name="price" placeholder="{{ __('Price') }}" value="{{ old('price') }}" required>
            @error('price')
            {{ $message }}
            @enderror
            <br>
            <input type="text" name="description" placeholder="{{ __('Description') }}" value="{{ old('description') }}" required>
            @error('description')
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
    </div>
@endsection
