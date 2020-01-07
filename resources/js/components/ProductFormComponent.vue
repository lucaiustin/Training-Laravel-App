<template>
    <div>
        <div class="container">
            <form method="POST" v-on:submit.prevent="onSubmit">
                <input type="text" v-model="title" v-bind:placeholder="$t('message.title')" value="title" required>
                <span v-model="titleErrors">{{ titleErrors }}</span>
                <br>
                <input type="text" v-model="title" v-bind:placeholder="$t('message.description')"
                       placeholder="Description" value="description" required>
                <span v-model="descriptionErrors">{{ descriptionErrors }}</span>
                <br>
                <input type="text" v-model="title" v-bind:placeholder="$t('message.price')" placeholder="Price"
                       value="price" required>
                <span v-model="priceErrors">{{ priceErrors }}</span>
                <br>
                <input type="file" @change="onFileChanged"/>
                <span v-model="imageErrors">{{ imageErrors }}</span>
                <br>
                <button type="submit">{{ $t('message.save') }}</button>
            </form>
            <br>
            <router-link to="/products">{{ $t('message.products') }}</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                title: '',
                description: '',
                price: '',
                image: null,
                titleErrors: '',
                descriptionErrors: '',
                priceErrors: '',
                imageErrors: ''
            }
        },

        mounted () {
            let self = this
            axios
                .get('/product/' + this.$route.params.id)
                .then(function (response) {
                    self.title = response.data.title,
                        self.description = response.data.description,
                        self.price = response.data.price
                })
                .catch(function (error) {
                    if (error.response.status === 404) {
                        console.log('Product does not exist')
                    }
                })
        },

        methods: {
            onFileChanged (event) {
                this.image = event.target.files[0]
            },

            onSubmit: function (event) {
                let self = this
                let formData = new FormData()
                formData.append('title', this.title)
                formData.append('description', this.description)
                formData.append('price', this.price)
                formData.append('image', this.image)
                formData.append('_token', this.csrf)

                this.titleErrors = ''
                this.descriptionErrors = ''
                this.priceErrors = ''
                this.imageErrors = ''

                let postUrl = '/product/'
                if (this.$route.params.id) {
                    formData.append('_method', 'PATCH')
                    postUrl = '/product/' + this.$route.params.id
                }

                axios.post(postUrl, formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(function (response) {
                        console.log(response.data)
                    })
                    .catch(function (error) {
                        if (error.response.status === 422) {
                            console.log(error.response.data.errors)
                            if (error.response.data.errors.hasOwnProperty('title')) {
                                self.titleErrors = error.response.data.errors.title[0]
                            }
                            if (error.response.data.errors.hasOwnProperty('description')) {
                                self.descriptionErrors = error.response.data.errors.description[0]
                            }
                            if (error.response.data.errors.hasOwnProperty('price')) {
                                self.priceErrors = error.response.data.errors.price[0]
                            }
                            if (error.response.data.errors.hasOwnProperty('image')) {
                                self.imageErrors = error.response.data.errors.image[0]
                            }
                        }
                    })

            },
        },

        computed: {
            csrf: function () {
                return document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
    }
</script>
