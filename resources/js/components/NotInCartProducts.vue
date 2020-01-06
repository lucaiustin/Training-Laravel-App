<template>
    <div>
        <div v-for="product in products" :key="product.id">
            <product v-bind:product="product"></product>
            <a v-bind:href="'/' + product.id" v-on:click.prevent="addProduct(product.id)">Add</a>
            <hr>
        </div>
    </div>
</template>

<script>
    var product = require('./ProductComponent.vue').default;

    export default {
        data: function () {
            return {
                products: []
            }
        },

        mounted () {
            axios
                .get('/')
                .then(response => {
                    this.products = response.data;
                });
        },

        methods: {
            addProduct: function (id) {
                axios
                    .get('/' + id)
                    .then(response => {
                        this.products = response.data;
                    });
            }
        },

        components: {
            'product' : product
        },
    }
</script>
