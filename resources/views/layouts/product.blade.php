<div class="product">
    <div class="product-image">
        <img src="{{ url('storage/images/', $product->image_name) }}">
    </div>
    <div class="product-info">
        <p>{{ $product->id }}</p>
        <p>{{ $product->title }}</p>
        <p>{{ $product->description }}</p>
        <p>{{ $product->price }}</p>
    </div>
</div>
