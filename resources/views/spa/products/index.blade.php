<div class="container">
        <div class="product-list" id="product-list"></div>

    <a href="#product">{{ __('Add') }}</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        {{ csrf_field() }}
        <button type="submit">{{ __('Logout') }}</button>
    </form>
</div>

