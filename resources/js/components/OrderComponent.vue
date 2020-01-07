<template>
    <div>
        <div class="container">
            <div>
                {{ order.name }}
                <br>
                {{ order.contact_details }}
                <br>
                {{ order.comments }}
                <br>
                {{ order.totalPrice }}
                <br>
                {{ order.created_at }}
                <br><br>
                <div v-for="product in products" :key="product.id">
                    <product v-bind:product="product"></product>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var product = require('./ProductComponent.vue').default
    export default {
        data: function () {
            return {
                order: [],
                products: []
            }
        },

        mounted () {
            let self = this
            axios
                .get('/order/' + this.$route.params.id)
                .then(response => {

                    this.order = response.data.order
                    this.products = response.data.products

                    var totalPrice = 0
                    for (var product in this.products) {
                        totalPrice += parseFloat(this.products[product].price)
                    }
                    this.order['totalPrice'] = totalPrice
                })
                .catch(function (error) {
                    if (error.response.status === 401) {
                        self.$router.push('/login')
                    }
                })
        },
        components: {
            'product': product
        },
    }
</script>
