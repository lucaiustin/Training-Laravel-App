<template>
    <div>
        <div class="container">
            <div v-for="order in orders" :key="order.id">
                <p> {{order.created_at}} </p>
                <p> {{order.contact_details}} </p>
                <p> {{order.prices_sum}} </p>
                <a  v-bind:href="'/order/' + order.id">View Order</a>
                <hr>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                orders: []
            }
        },

        mounted () {
            axios
                .get('/orders')
                .then(response => {
                    this.orders = response.data;
                });
        },
    }
</script>
