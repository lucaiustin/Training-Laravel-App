<div>
    {{ $name }}
    {{ $contact_details }}
    {{ $comments }}

    @foreach ($products as $product)
        <ul>
            <li>{{ $product->title }}</li>
            <img src="{{url('storage/', $product->image_name)}}">
            <li>{{ $product->description }}</li>
            <li>{{ $product->price }}</li>
            <li>{{ $product->image_name }}</li>
        </ul>
    @endforeach
</div>
