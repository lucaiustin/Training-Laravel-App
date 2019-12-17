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
@endsection


</body>
</html>
