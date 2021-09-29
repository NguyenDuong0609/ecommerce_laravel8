/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import store from './store/index';

Vue.use(VueRouter)

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-component', require('./components/AdminComponent.vue').default);
Vue.component('login', require('./pages/Login').default);

import DashBoard from './pages/DashBoard';
import Producer from './pages/Producer';
import TypeProduct from './pages/TypeProduct';
import User from './pages/User';
import Category from './pages/Category';
import ListProduct from './pages/product/list';
import CreateProduct from './pages/product/create';
import Coupon from './pages/Coupon';

const routes = [
    {
        path: '/admin',
        component: DashBoard
    },
    {
        path: '/admin/producer',
        component: Producer,
        name: 'producer',
    },
    {
        path: '/admin/type-product',
        component: TypeProduct,
        name: 'typeProduct',
    },
    {
        path: '/admin/user',
        component: User,
        name: 'user',
    },
    {
        path: '/admin/category',
        component: Category,
        name: 'category',
    },
    {
        path: '/admin/product',
        component: ListProduct,
        name: 'product',
    },
    {
        path: '/admin/product/add',
        component: CreateProduct,
        name: 'createproduct',
    },
    {
        path: '/admin/product/:idProduct',
        component: CreateProduct,
        name: 'getproduct',
    },
    {
        path: '/admin/coupon',
        component: Coupon,
        name: 'coupon',
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#app',
    router,
    store: store,
});
