<template>
    <div>
        <div v-for="product in products" :key="product.id">
            <product v-bind:product="product"></product>
            <a v-bind:href="'/' + product.id" v-on:click.prevent="removeProduct(product.id)">{{ $t('message.remove')
                }}</a>
            <hr>
        </div>
        <form method="POST" v-on:submit.prevent="onSubmit">
            <input type="text" v-model="name" v-bind:placeholder="$t('message.name')" required>
            <span v-model="nameErrors">{{ nameErrors }}</span>
            <br>
            <input type="text" v-model="contact_details" v-bind:placeholder="$t('message.contactDetails')" required>
            <span v-model="contactDetailsErrors">{{ contactDetailsErrors }}</span>
            <br>
            <textarea v-model="comments" rows="10" cols="30" v-bind:placeholder="$t('message.comments')"
                      required></textarea>
            <span v-model="commentsErrors">{{ commentsErrors }}</span>
            <br>
            <button type="submit">{{ $t('message.checkout') }}</button>
        </form>
        <span v-model="submitForm">{{ submitForm }}</span>
        <router-link to="/">{{ $t('message.index') }}</router-link>

    </div>
</template>

<script>
    var product = require('./ProductComponent.vue').default
    import mixin from '../mixin'

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

        mixins: [mixin],

        mounted () {
            axios
                .get('/cart')
                .then(response => {
                    this.products = response.data
                })
        },

        methods: {
            onSubmit: function (event) {
                let self = this

                let formData = new FormData()
                formData.append('name', this.name)
                formData.append('contact_details', this.contact_details)
                formData.append('comments', this.comments)
                formData.append('_token', self.csrf)

                axios.post('/cart', formData)
                    .then(function (response) {
                        if (response.data.hasOwnProperty('msg')) {
                            axios
                                .get('/removeAllFromCart')
                                .then(response => {
                                    self.$router.push('/')
                                })
                        }
                    })
                    .catch(function (error) {
                        if (error.response.status === 422) {
                            if (error.response.data.errors.hasOwnProperty('name')) {
                                self.nameErrors = error.response.data.errors.name[0]
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
                        this.products = response.data
                    })
            }
        },

        components: {
            'product': product
        },
    }
</script>
