<div class="container">
    <div class="product-list"></div>
    <a href="#">{{__('Go to index')}}</a>

    <form method="POST" id="cartForm">
        {{ csrf_field() }}
        <input type="text" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required>
        <span class="validation-name-error"></span>
        <br>
        <input type="text" name="contact_details" placeholder="{{ __('Contact Details') }}" value="{{ old('contact_details') }}" required>
        <span class="validation-contact-details-error"></span>
        <br>
        <textarea name="comments" rows="10" cols="30" placeholder="{{ __('Comments') }}" required>{{ old('comments') }}</textarea>
        <span class="validation-comments-error"></span>
        <br>
        <button type="submit">{{ __('Checkout') }}</button>
    </form>

    <div class="submit-message"></div>
</div>
