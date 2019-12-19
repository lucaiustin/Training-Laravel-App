<template>
    <div>
        <div class="product">
            <div class="product-image">
                <img v-bind:src="'storage/images/' + product.image_name">
            </div>
            <div class="product-info">
                <p> {{ product.id }} </p>
                <p> {{ product.title }} </p>
                <p> {{ product.description }} </p>
                <p> {{ product.price }} </p>
            </div>
        </div>
        <a v-bind:href="product.id">Add</a>
        <hr>
    </div>
</template>

<script>
    export default {
        props: ['product']
    }
</script>
