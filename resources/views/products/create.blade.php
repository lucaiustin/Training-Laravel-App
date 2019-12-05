@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/products" enctype="multipart/form-data">

            {{ csrf_field()  }}
            <ul>
                <li><input type="text" name="title" placeholder="{{ __('Title') }}" value="{{ old('title') }}" required></li>
                <li><input type="text" name="price" placeholder="{{ __('Price') }}" value="{{ old('price') }}" required></li>
                <li><textarea name="description" placeholder="{{ __('Description') }}" required>{{ old('description') }}</textarea></li>
                <input type="file" name="image" />
            </ul>
            <button type="submit">{{ __('Create') }}</button>
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
