<template>
    <div>
        <div class="container">
            <div v-for="order in orders" :key="order.id">
                <p> {{order.created_at}} </p>
                <p> {{order.contact_details}} </p>
                <p> {{order.prices_sum}} </p>
                <router-link :to="{ name: 'order', params: { id: order.id }}">{{ $t('message.viewOrder') }}
                </router-link>
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
            let self = this
            axios
                .get('/orders')
                .then(response => {
                    this.orders = response.data
                })
                .catch(function (error) {
                    if (error.response.status === 401) {
                        self.$router.push('login')
                    }
                })
        },
    }
</script>
