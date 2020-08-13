require('./bootstrap');
import VueRouter from "vue-router";
window.axios = require('axios');

window.Vue = require('vue');
window.Vue.use(VueRouter);

const home = require('./components/home.vue').default;
const cart = require('./components/cart.vue').default;
const checkout = require('./components/checkout.vue').default;
const login = require('./components/login.vue').default;

//Vue.component('example-component', require('./components/example.vue').default);
const routes = [
    {
        path: '/home',
        name: 'home',
        component: home
    },
    {
        path: '/cart',
        name: 'cart',
        component: cart
    },
    {
        path: '/checkout',
        name: 'checkout',
        component: checkout
    },
    {
        path: '/login',
        name: 'login',
        component: login
    },
];

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    router
});
