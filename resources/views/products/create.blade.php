@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/products">

            {{ csrf_field()  }}
            <ul>
                <li><input type="text" name="title" placeholder="Title"></li>
                <li><input type="text" name="price" placeholder="Price"></li>
                <li><textarea name="description" placeholder="Description"></textarea></li>
                <li><input type="text" name="image_name" placeholder="Image Name"></li>
            </ul>
            <button type="submit">Create</button>
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
