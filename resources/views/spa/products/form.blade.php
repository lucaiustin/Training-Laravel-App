<div class="container">
    <form method="POST" action="/product" id="addPrdouct" enctype="multipart/form-data">
        {{ csrf_field()  }}

        <input type="text" name="title" placeholder="{{ __('Title') }}" value="{{ old('title') }}" required>
        <span class="validation-title-error"></span>
        <br>
        <input type="text" name="description" placeholder="{{ __('Description') }}" value="{{ old('description') }}" required>
        <span class="validation-description-error"></span>
        <br>
        <input type="text" name="price" placeholder="{{ __('Price') }}" value="{{ old('price') }}" required>
        <span class="validation-price-error"></span>
        <br>
        <input type="file" name="image" />
        <span class="validation-image-error"></span>
        <br>
        <button type="submit">{{ __('Save') }}</button>
    </form>
    <br>
    <a href="#products">{{ __('Products') }}</a>
</div>

