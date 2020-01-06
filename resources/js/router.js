import VueRouter from 'vue-router';

let NotInCartProducts = require('./components/NotInCartProducts.vue').default;
let CartProducts = require('./components/CartProducts.vue').default;
let ProductsComponent = require('./components/ProductsComponent.vue').default;
let ProductFormComponent = require('./components/ProductFormComponent.vue').default;
let OrdersComponent = require('./components/OrdersComponent.vue').default;
let OrderComponent = require('./components/OrderComponent.vue').default;

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
        component: ProductsComponent
    },

    {
        path: '/product/:id',
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
        component: OrderComponent
    }
];

export default new VueRouter({
    routes,
    linkActiveClass: 'is-active'
});
