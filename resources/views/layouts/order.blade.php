<div>
    <p>{{ __('This is order') }} {{ $order->id }}</p>
    <p>{{ $order->name }}</p>
    <p>{{ $order->contact_details }}</p>
    <p>{{ $order->products->sum('price') }}</p>
</div>
