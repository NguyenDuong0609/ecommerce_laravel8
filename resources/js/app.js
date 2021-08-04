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

import DashBoard from './pages/DashBoard';

const routes = [
    {
        path: '/admin/',
        component: DashBoard
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
