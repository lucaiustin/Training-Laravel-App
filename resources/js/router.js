import VueRouter from 'vue-router';

let NotInCartProducts = require('./components/NotInCartProducts.vue').default;
let CartProducts = require('./components/CartProducts.vue').default;
let ProductsComponent = require('./components/ProductsComponent.vue').default;

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
    }
];

export default new VueRouter({
    routes,
    linkActiveClass: 'is-active'
});
