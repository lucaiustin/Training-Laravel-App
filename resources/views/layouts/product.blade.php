<div>
    <p>This is product {{ $product->id }}</p>
    <img src="{{ url('storage/', $product->image_name) }}">
    <p>{{ $product->title }}</p>
    <p>{{ $product->description }}</p>
    <p>{{ $product->price }}</p>
</div>
