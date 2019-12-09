@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/product" enctype="multipart/form-data">
            {{ csrf_field()  }}

            <ul>
                <li><input type="text" name="title" placeholder="{{ __('Title') }}" value="{{ old('title') }}" required></li>
                <li><input type="text" name="price" placeholder="{{ __('Price') }}" value="{{ old('price') }}" required></li>
                <li><textarea name="description" placeholder="{{ __('Description') }}" required>{{ old('description') }}</textarea></li>
                <p><input type="text" name="image_name" placeholder="{{ __('Image Name') }}" value="{{  old('image_name') }}" required></p>
                <input type="file" name="image" />
            </ul>
            <button type="submit">{{ __('Create') }}</button>
        </form>

        @include('layouts.errors')
    </div>
@endsection
