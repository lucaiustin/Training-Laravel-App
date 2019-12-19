<template>
    <div>
        <products v-bind:products="products"></products>
    </div>

</template>

<script>
    Vue.component('products', require('./ProductsComponent.vue').default);
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
                    this.products = response.data
                    console.log(this.products )
                })
        }
    }
</script>
