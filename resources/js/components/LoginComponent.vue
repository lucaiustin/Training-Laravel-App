<template>
    <div>
        <div class="container">
            <form method="POST" v-on:submit.prevent="onSubmit">

                <input type="text" v-model="username" v-bind:placeholder="$t('message.username')" required>
                <span v-model="usernameErrors">{{ usernameErrors }}</span>
                <br>
                <input type="password" v-model="password" v-bind:placeholder="$t('message.password')" required>
                <span v-model="passwordErrors">{{ passwordErrors }}</span>
                <br>
                <button type="submit">{{ $t('message.login') }}</button>
            </form>
            <span v-model="tryAgainMessage">{{ tryAgainMessage }}</span>
        </div>
    </div>
</template>

<script>
    import mixin from '../mixin'
    export default {
        data: function () {
            return {
                username: '',
                password: '',
                usernameErrors: '',
                passwordErrors: '',
                tryAgainMessage: ''
            }
        },

        mixins: [mixin],

        methods: {
            onSubmit: function (event) {
                let self = this
                let formData = new FormData()
                formData.append('username', this.username)
                formData.append('password', this.password)
                formData.append('_token', self.csrf)
                this.usernameErrors = ''
                this.passwordErrors = ''
                this.tryAgainMessage = ''

                axios.post('/login', formData)
                    .then(function (response) {
                        self.$router.push('products')
                    })
                    .catch(function (error) {
                        if (error.response.data.errors.hasOwnProperty('username')) {
                            self.usernameErrors = error.response.data.errors.username[0]
                        }
                        if (error.response.data.errors.hasOwnProperty('password')) {
                            self.passwordErrors = error.response.data.errors.password[0]
                        }
                        self.tryAgainMessage = 'Please try again.'
                    })
            }
        },

    }
</script>
