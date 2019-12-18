<html>
<head>
    <!-- Load the jQuery JS library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Custom JS script -->
    <script type="text/javascript">

        $(document).ready(function () {

            function renderList (products, page) {
                html = ''

                $.each(products, function (key, product) {
                    html += [
                        '<div class="product">' +
                        '<div class="product-image">' +
                        '<img src="storage/images/' + product.image_name + '">' +
                        '</div>' +
                        '<div class="product-info">' +
                        '<p>' + product.id + '</p>' +
                        '<p>' + product.title + '</p>' +
                        '<p>' + product.description + '</p>' +
                        '<p>' + product.price + '</p>' +
                        '</div>' +
                        '</div>'
                    ].join('')

                    if (page.localeCompare('#cart') === 0) {
                        html += ['<a href="#cart" class="removeFromCart" data-value="' + product.id + '">{{ __('Remove') }}</a>'].join('')
                    } else if (page.localeCompare('#products') === 0) {
                        html += [
                            '<a href="#product/' + product.id + '">Edit</a>' +
                            '<form method="POST" class="deleteForm" action="/products/' + product.id + '">' +
                            '@method("DELETE")' +
                            '@csrf' +
                            '<button type="submit">{{ __('Delete Product') }}</button>' +
                            '</form>'
                        ].join('')
                    } else {
                        html += ['<a href="#" class="addToCart" data-value="' + product.id + '">{{ __('Add') }}</a>'].join('')
                    }

                    html += ['<hr>'].join('')
                })

                return html
            }

            $('body').on('click', 'a.removeFromCart', function () {
                $.ajax('/cart/' + $(this).attr('data-value'), {
                    dataType: 'json',
                    success: function (response) {
                        $('.cart .product-list').html(renderList(response, '#cart'))
                    },
                })
            })

            $('body').on('click', 'a.addToCart', function () {
                $.ajax('/' + $(this).attr('data-value'), {
                    dataType: 'json',
                    success: function (response) {
                        $('.index .product-list').html(renderList(response, '#'))
                    },
                })
            })

            $('body').on('submit', '.deleteForm', function (event) {
                event.preventDefault();
                let formData = new FormData($('.deleteForm')[0])

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $(this).attr('action'),
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('.products .product-list').html(renderList(response, '#products'))
                    },
                })
            })

            $('#addPrdouct').submit(function (event) {
                event.preventDefault()
                let formData = new FormData($('#addPrdouct')[0])

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/product',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        window.location = '#products';
                    },
                    error: function (data) {
                        validationErrors = data.responseJSON.errors
                        if (validationErrors.hasOwnProperty('title')) {
                            $('.validation-title-error').html(data.responseJSON.errors.title)
                        }

                        if (validationErrors.hasOwnProperty('contact_details')) {
                            $('.validation-description-error').html(data.responseJSON.errors.description)
                        }

                        if (validationErrors.hasOwnProperty('price')) {
                            $('.validation-price-error').html(data.responseJSON.errors.price)
                        }

                        if (validationErrors.hasOwnProperty('image')) {
                            $('.validation-image-error').html(data.responseJSON.errors.image)
                        }
                    }
                })
            })

            $('#cartForm').submit(function (event) {
                event.preventDefault()
                let formData = new FormData($('#cartForm')[0])

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/cart',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('.submit-message').html(data.msg)
                    },
                    error: function (data) {
                        validationErrors = data.responseJSON.errors
                        if (validationErrors.hasOwnProperty('name')) {
                            $('.validation-name-error').html(data.responseJSON.errors.name)
                        }

                        if (validationErrors.hasOwnProperty('contact_details')) {
                            $('.validation-contact-details-error').html(data.responseJSON.errors.contact_details)
                        }

                        if (validationErrors.hasOwnProperty('comments')) {
                            $('.validation-comments-error').html(data.responseJSON.errors.comments)
                        }
                    }
                })
            })

            /**
             * URL hash change handler
             */
            window.onhashchange = function () {
                // First hide all the pages
                $('.page').hide()

                var parts = window.location.hash.split('/')

                switch (parts[0]) {
                    case '#cart':
                        // Show the cart page
                        $('.cart').show()
                        //Load the cart products from the server
                        $.ajax('/cart', {
                            dataType: 'json',
                            success: function (response) {
                                // Render the products in the cart list
                                $('.cart .product-list').html(renderList(response, parts[0]))
                            }
                        })
                        break
                    case '#products':
                        // Show the cart page
                        $('.products').show()
                        //Load the cart products from the server
                        $.ajax('/products', {
                            dataType: 'json',
                            success: function (response) {
                                // Render the products in the cart list
                                $('.products .product-list').html(renderList(response, parts[0]))
                            }
                        })
                        break
                    case '#product':
                        if (typeof parts[1] !== 'undefined') {
                            $.ajax('/product/' + parts[1], {
                                dataType: 'json',
                                success: function (response) {
                                    console.log(response);
                                    $('input[name=title]').val(response.title);
                                    $('input[name=description]').val(response.description);
                                    $('input[name=price]').val(response.price);
                                },
                                error: function (data) {
                                    console.log(data);
                                }
                            })
                        }
                        $('.product').show()
                        break
                    default:
                        // If all else fails, always default to index
                        // Show the index page
                        $('.index').show()
                        // Load the index products from the server
                        $.ajax('/', {
                            dataType: 'json',
                            success: function (response) {
                                // Render the products in the index list
                                $('.index .product-list').html(renderList(response, parts[0]))
                            }
                        })
                        break
                }
            }

            window.onhashchange()
        })
    </script>
</head>
<body>
@extends('layouts.app')

@section('content')
    <!-- The index page -->
    <div class="page index">
        @include('spa.shop.index')
    </div>

    <!-- The cart page -->
    <div class="page cart">
        @include('spa.shop.cart')
    </div>

    <div class="page products">
        @include('spa.products.index')
    </div>

    <div class="page product">
        @include('spa.products.form')
    </div>

    <div class="page orders">
        @include('spa.orders.index')
    </div>

@endsection


</body>
</html>
