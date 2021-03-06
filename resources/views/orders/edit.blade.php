@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/orders/{{ $order->id }}">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            <p><input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ $order->name }}" required></p>
            <p><textarea name="contact_details"  placeholder="{{ __('Contact Details') }}" required>{{ $order->contact_details }}</textarea></p>
            <p><textarea name="comments" placeholder="{{ __('Comments') }}" required>{{ $order->comments }}</textarea></p>
            <p><button type="submit">{{ __('Update Order') }}</button></p>
        </form>

        @include('layouts.errors')
    </div>
@endsection
