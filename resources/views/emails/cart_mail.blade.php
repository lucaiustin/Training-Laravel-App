<div>
    {{ $name }}
    {{ $contact_details }}
    {{ $comments }}

    @foreach ($products as $product)
        <ul>
            <li>{{ $product->title }}</li>
            <li>{{ $product->description }}</li>
            <li>{{ $product->price }}</li>
            <li>{{ $product->image_name }}</li>
        </ul>
    @endforeach
</div>
