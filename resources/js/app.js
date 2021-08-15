/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router';

Vue.use(VueRouter)

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('admin-component', require('./components/AdminComponent.vue').default);
Vue.component('login', require('./pages/Login').default);

import DashBoard from './pages/DashBoard';
import User from './pages/User';
import Category from './pages/Category';

const routes = [
    {
        path: '/admin',
        component: DashBoard
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
    }
];

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    el: '#app',
    router
});
