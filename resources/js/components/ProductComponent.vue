<template>
    <div>
        <div class="product">
            <div class="product-image">
                <img v-bind:src="baseUrl + '/storage/images/' + product.image_name">
            </div>
            <div class="product-info">
                <p> {{ product.id }} </p>
                <p> {{ product.title }} </p>
                <p> {{ product.description }} </p>
                <p> {{ product.price }} </p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['product'],
        computed: {
            baseUrl: function () {
                return window.location.origin;
            }
        }
    }
</script>
