@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/login">
            {{ csrf_field()  }}

            <input type="text" name="username" placeholder="{{ __('Username') }}" value="{{ old('username') }}" required>
            @error('username')
            {{ $message }}
            @enderror
            <br>
            <input type="password" name="password" placeholder="{{ __('Password') }}" value="{{ old('password') }}" required>
            @error('password')
            {{ $message }}
            @enderror
            <br>
            <button type="submit">{{ __('Login') }}</button>
        </form>
    </div>
@endsection
