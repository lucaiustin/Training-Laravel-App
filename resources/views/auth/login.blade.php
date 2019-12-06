@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/login">
            {{ csrf_field()  }}

            <ul>
                <li><input type="text" name="username" placeholder="{{ __('Username') }}" value="{{ old('username') }}" required></li>
                <li><input type="password" name="password" placeholder="{{ __('Password') }}" value="{{ old('password') }}" required></li>
            </ul>
            <button type="submit">{{ __('Login') }}</button>
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
