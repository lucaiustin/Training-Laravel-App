<div>
    {{ $name }}
    {{ $contact_details }}
    {{ $comments }}

    @foreach ($products as $product)
        @include('layouts.product')
    @endforeach
</div>
