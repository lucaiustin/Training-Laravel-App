<html>
<head>
    <!-- Load the jQuery JS library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Custom JS script -->
    <script type="text/javascript">

        $(document).ready(function () {

            function renderProduct (product) {
                return [
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
                ].join('');
            }

            function renderProductsList (products, page) {
                var html = '';
                $.each(products, function (key, product) {
                    html += renderProduct(product);

                    if (page.localeCompare('#cart') === 0) {
                        html += ['<a href="#cart" class="removeFromCart" data-value="' + product.id + '">{{ __('Remove') }}</a>'].join('');
                    } else if (page.localeCompare('#products') === 0) {
                        html += [
                            '<a href="#product/' + product.id + '">Edit</a>' +
                            '<form method="POST" class="deleteForm" action="/products/' + product.id + '">' +
                                '@method("DELETE")' +
                                '@csrf' +
                                '<button type="submit">{{ __('Delete Product') }}</button>' +
                            '</form>'
                        ].join('');
                    } else {
                        html += ['<a href="#" class="addToCart" data-value="' + product.id + '">{{ __('Add') }}</a>'].join('');
                    }

                    html += ['<hr>'].join('');
                })

                return html;
            }

            function renderOrdersList (orders) {
                var html = '';
                $.each(orders, function (key, order) {
                    html += [
                        '<p>' + order.created_at + '</p>' +
                        '<p>' + order.contact_details + '</p>' +
                        '<p>' + order.prices_sum + '</p>' +
                        '<a href="/order/' + order.id + '">{{ __('View Order') }}</a>' +
                        '<hr>'
                    ].join('');
                })
                return html;
            }

            function getPricesSum (products) {
                var sum = 0;
                $.each(products, function (key, product) {
                    sum += parseFloat(product.price);
                })
                return sum;
            }

            function renderOrder (response) {
                var order = response.order;
                var products = response.products;
                var html = [order.name +
                '<br>' +
                order.contact_details +
                '<br>' +
                order.comments +
                '<br>' +
                getPricesSum(products) +
                '<br>' +
                order.created_at +
                '<br><br>'].join('');

                $.each(products, function (key, product) {
                    html += renderProduct(product);
                })
                return html;
            }

            $('body').on('click', 'a.removeFromCart', function () {
                $.ajax('/cart/' + $(this).attr('data-value'), {
                    dataType: 'json',
                    success: function (response) {
                        $('.cart .product-list').html(renderProductsList(response, '#cart'));
                    },
                });
            });

            $('body').on('click', 'a.addToCart', function () {
                $.ajax('/' + $(this).attr('data-value'), {
                    dataType: 'json',
                    success: function (response) {
                        $('.index .product-list').html(renderProductsList(response, '#'));
                    },
                });
            });

            $('body').on('submit', '.deleteForm', function (event) {
                event.preventDefault();
                var formData = new FormData($('.deleteForm')[0]);

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
                        $('.products .product-list').html(renderProductsList(response, '#products'));
                    },
                });
            });

            $('#productsForm').submit(function (event) {
                event.preventDefault();
                var formData = new FormData($('#productsForm')[0])

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $('#productsForm').attr('action'),
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        window.location = '#products';
                    },
                    error: function (data) {
                        validationErrors = data.responseJSON.errors;
                        if (validationErrors.hasOwnProperty('title')) {
                            $('.validation-title-error').html(data.responseJSON.errors.title);
                        }

                        if (validationErrors.hasOwnProperty('contact_details')) {
                            $('.validation-description-error').html(data.responseJSON.errors.description);
                        }

                        if (validationErrors.hasOwnProperty('price')) {
                            $('.validation-price-error').html(data.responseJSON.errors.price);
                        }

                        if (validationErrors.hasOwnProperty('image')) {
                            $('.validation-image-error').html(data.responseJSON.errors.image);
                        }
                    }
                });
            });

            $('#cartForm').submit(function (event) {
                event.preventDefault();
                let formData = new FormData($('#cartForm')[0]);

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
                        $('.submit-message').html(data.msg);
                    },
                    error: function (data) {
                        validationErrors = data.responseJSON.errors;
                        if (validationErrors.hasOwnProperty('name')) {
                            $('.validation-name-error').html(data.responseJSON.errors.name);
                        }

                        if (validationErrors.hasOwnProperty('contact_details')) {
                            $('.validation-contact-details-error').html(data.responseJSON.errors.contact_details);
                        }

                        if (validationErrors.hasOwnProperty('comments')) {
                            $('.validation-comments-error').html(data.responseJSON.errors.comments);
                        }
                    }
                })
            })

            /**
             * URL hash change handler
             */
            window.onhashchange = function () {
                // First hide all the pages
                $('.page').hide();

                var parts = window.location.hash.split('/');

                switch (parts[0]) {
                    case '#cart':
                        // Show the cart page
                        $('.cart').show();
                        //Load the cart products from the server
                        $.ajax('/cart', {
                            dataType: 'json',
                            success: function (response) {
                                // Render the products in the cart list
                                $('.cart .product-list').html(renderProductsList(response, parts[0]));
                            }
                        })
                        break;
                    case '#products':
                        $('.products').show();
                        $.ajax('/products', {
                            dataType: 'json',
                            success: function (response) {
                                $('.products .product-list').html(renderProductsList(response, parts[0]));
                            }
                        })
                        break;
                    case '#product':
                        if (typeof parts[1] !== 'undefined') {
                            $.ajax('/product/' + parts[1], {
                                dataType: 'json',
                                success: function (response) {
                                    $("#productsForm").attr('action', '/product/' + parts[1]);
                                    $("#patch-method").html('{{ method_field('PATCH') }}');
                                    $('input[name=title]').val(response.title);
                                    $('input[name=description]').val(response.description);
                                    $('input[name=price]').val(response.price);
                                },
                            })
                        }
                        $('.product').show();
                        break;
                    case '#orders':
                        $('.orders').show();
                        $.ajax('/orders', {
                            dataType: 'json',
                            success: function (response) {
                                $('.orders-list').html(renderOrdersList(response));
                            }
                        })
                        break;
                    case '#order':
                        $('.order').show();
                        $.ajax('/order/' + parts[1], {
                            dataType: 'json',
                            success: function (response) {
                                $('.show-order').html(renderOrder(response));
                            }
                        })
                        break;
                    default:
                        // If all else fails, always default to index
                        // Show the index page
                        $('.index').show();
                        // Load the index products from the server
                        $.ajax('/', {
                            dataType: 'json',
                            success: function (response) {
                                // Render the products in the index list
                                $('.index .product-list').html(renderProductsList(response, parts[0]));
                            }
                        })
                        break;
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

    <div class="page order">
        @include('spa.orders.show')
    </div>

@endsection


</body>
</html>
