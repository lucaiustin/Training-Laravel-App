<template>
    <div>
        <div v-for="product in products" :key="product.id">
            <product v-bind:product="product"></product>
            <a v-bind:href="'product/' +  product.id ">Edit</a>
            <form method="POST">
                <button type="submit" v-on:click.prevent="deleteProduct(product.id)">Delete Product</button>
            </form>
            <hr>
        </div>
        <a href="/vue/product">Add</a>

        <form id="frm-logout" action="/vue/logout" method="POST">
            <button type="submit">Logout</button>
        </form>
    </div>
</template>

<script>
    var product = require('./ProductComponent.vue').default;
    export default {
        data: function () {
            return {
                products: [],
                _token: '',
                _method: 'DELETE'
            }
        },

        mounted () {
            axios
                .get('/products')
                .then(response => {
                    this.products = response.data;
                });
        },

        methods: {
            deleteProduct: function (id) {
                let self = this;
                    axios.delete('/products/' + id, {
                        _token: this.csrf,
                        _method: this.method
                    })
                    .then(function (response) {
                        self.products = response.data;
                    })
                    .catch(function (error) {
                       console.log(error);
                    })
            }
        },

        computed: {
            csrf: function () {
                return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            }
        },

        components: {
            'product' : product
        },
    }
</script>
