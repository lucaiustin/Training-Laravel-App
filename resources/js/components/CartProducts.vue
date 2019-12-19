<template>
    <div>
        <products v-bind:products="products"></products>
        <form method="POST" v-on:submit.prevent="onSubmit">
            <input type="text" v-model="name" placeholder="Name" value="" required>
            <br>
            <input type="text" v-model="contact_details" placeholder="Contact Details" value="" required>
            <br>
            <textarea v-model="comments" rows="10" cols="30" placeholder="Comments" required></textarea>
            <input type="hidden" name="_token" :value="csrf">
            <br>
            <button type="submit">'Checkout</button>
        </form>

    </div>
</template>

<script>
    Vue.component('products', require('./ProductsComponent.vue').default);
    export default {
        data: function () {
            return {
                products: [],
                name: '',
                contact_details: '',
                comments: '',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },

        mounted () {
            axios
                .get('/cart')
                .then(response => {
                    this.products = response.data
                    console.log(this.products )
                })
        },
        methods: {
            onSubmit: function (event) {
                axios.post('/cart', {
                    name: this.name,
                    contact_details: this.contact_details,
                    comments:this.comments,
                    _token:this.csrf
                })
                    .then(function (response) {
                        console.log(response)
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            }
        },
    }
</script>
