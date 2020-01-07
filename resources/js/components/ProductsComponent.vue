<template>
    <div>
        <div v-for="product in products" :key="product.id">
            <product v-bind:product="product"></product>
            <router-link :to="{ name: 'product', params: { id: product.id }}">{{ $t('message.edit') }}</router-link>
            <form method="POST">
                <button type="submit" v-on:click.prevent="deleteProduct(product.id)">{{ $t('message.delete') }}</button>
            </form>
            <hr>
        </div>
        <router-link to="/product">{{ $t('message.add') }}</router-link>
        <form id="frm-logout" action="/vue/logout" method="POST">
            <button type="submit">{{ $t('message.logout') }}</button>
        </form>
    </div>
</template>

<script>
    var product = require('./ProductComponent.vue').default
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
                    console.log(response.data)
                    this.products = response.data
                }).catch(function (error) {
                console.log(error)
            })
        },

        methods: {
            deleteProduct: function (id) {
                let self = this
                axios.delete('/products/' + id, {
                    _token: this.csrf,
                    _method: this.method
                })
                    .then(function (response) {
                        self.products = response.data
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            }
        },

        computed: {
            csrf: function () {
                return document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },

        components: {
            'product': product
        },
    }
</script>
