/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')
import VueRouter from 'vue-router'
import VueI18n from 'vue-i18n'
import router from './router'

Vue.use(VueI18n)
Vue.use(VueRouter)

const messages = {
    en: {
        message: {
            add: 'Add',
            cart: 'Go to Cart',
            remove: 'Remove',
            checkout: 'Checkout',
            index: 'Go to index',
            name: 'Name',
            contactDetails: 'Contact Details',
            comments: 'Comments',
            edit: "Edit",
            delete: "Delete Product",
            logout: "Logout",
            title: "Title",
            description: "Description",
            price: "Price",
            save: "Save",
            products: "Products",
            viewOrder: "View Order",

        }
    }
}
const i18n = new VueI18n({
    locale: 'en', // set locale
    messages, // set locale messages
})

const app = new Vue({
    el: '#app',
    i18n,
    router,
})

