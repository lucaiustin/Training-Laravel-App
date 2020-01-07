import VueRouter from 'vue-router'

let NotInCartProducts = require('./components/NotInCartProductsComponent.vue').default
let CartProducts = require('./components/CartProductsComponent.vue').default
let ProductsComponent = require('./components/ProductsComponent.vue').default
let ProductFormComponent = require('./components/ProductFormComponent.vue').default
let OrdersComponent = require('./components/OrdersComponent.vue').default
let OrderComponent = require('./components/OrderComponent.vue').default
let LoginComponent = require('./components/LoginComponent.vue').default

let routes = [
    {
        path: '/',
        component: NotInCartProducts
    },

    {
        path: '/cart/',
        component: CartProducts
    },

    {
        path: '/products/',
        name: 'products',
        component: ProductsComponent
    },

    {
        path: '/product/:id',
        name: 'product',
        component: ProductFormComponent
    },

    {
        path: '/product/',
        component: ProductFormComponent
    },

    {
        path: '/orders/',
        component: OrdersComponent
    },

    {
        path: '/order/:id',
        name: 'order',
        component: OrderComponent
    },

    {
        path: '/login/',
        name: 'login',
        component: LoginComponent
    }
]

export default new VueRouter({
    routes,
    linkActiveClass: 'is-active'
})
