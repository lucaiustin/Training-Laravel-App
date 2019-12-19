<template>
    <div>
       <product v-for="product in products" :key="product.id" v-bind:product="product"></product>
    </div>
</template>

<script>
    Vue.component('product', require('./ProductComponent.vue').default);
    export default {
        props: ['products']
    }
</script>
