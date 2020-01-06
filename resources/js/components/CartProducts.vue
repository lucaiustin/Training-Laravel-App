<template>
    <div>
        <div v-for="product in products" :key="product.id">
            <product v-bind:product="product"></product>
            <a v-bind:href="'/' + product.id" v-on:click.prevent="removeProduct(product.id)">Remove</a>
            <hr>
        </div>
        <form method="POST" v-on:submit.prevent="onSubmit">
            <input type="text" v-model="name" placeholder="Name" value="" required>
            <span v-model="nameErrors">{{ nameErrors }}</span>
            <br>
            <input type="text" v-model="contact_details" placeholder="Contact Details" value="" required>
            <span v-model="contactDetailsErrors">{{ contactDetailsErrors }}</span>
            <br>
            <textarea v-model="comments" rows="10" cols="30" placeholder="Comments" required></textarea>
            <span v-model="commentsErrors">{{ commentsErrors }}</span>
            <input type="hidden" name="_token" :value="csrf">
            <br>
            <button type="submit">Checkout</button>
        </form>
        <span v-model="submitForm">{{ submitForm }}</span>

    </div>
</template>

<script>
    var product = require('./ProductComponent.vue').default;

    export default {
        data: function () {
            return {
                products: [],
                name: '',
                contact_details: '',
                comments: '',
                nameErrors: '',
                contactDetailsErrors: '',
                commentsErrors: '',
                submitForm: ''
            }
        },

        mounted () {
            axios
                .get('/cart')
                .then(response => {
                    this.products = response.data;
                });
        },

        methods: {
            onSubmit: function (event) {
                let self = this;
                axios.post('/cart', {
                    name: this.name,
                    contact_details: this.contact_details,
                    comments: this.comments,
                    _token: this.csrf
                })
                .then(function (response) {
                    if (response.data.hasOwnProperty('msg')) {
                        self.submitForm = response.data.msg;
                    }
                })
                .catch(function (error) {
                    if (error.response.status === 422) {
                        if (error.response.data.errors.hasOwnProperty('name')) {
                            self.nameErrors = error.response.data.errors.name[0];
                        }
                        if (error.response.data.errors.hasOwnProperty('contact_details')) {
                            self.contactDetailsErrors = error.response.data.errors.contact_details[0]
                        }
                        if (error.response.data.errors.hasOwnProperty('comments')) {
                            self.commentsErrors = error.response.data.errors.comments[0]
                        }
                    }
                })
            },

            removeProduct: function (id) {
                axios
                    .get('/cart/' + id)
                    .then(response => {
                        this.products = response.data;
                    });
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
