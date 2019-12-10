<div>
    <p>{{ $name }}</p>
    <p>{{ $contact_details }}</p>
    <p>{{ $comments }}</p>

    @foreach ($products as $product)
        @include('layouts.product')
    @endforeach
</div>
