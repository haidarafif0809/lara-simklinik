
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 require('./bootstrap');
 window.Vue = require('vue');

 
 var VueResource = require('vue-resource');
 Vue.use(VueResource);
 import VueRouter from 'vue-router';
 import VueSwal from 'vue-swal'
 import Spinner from 'vue-simple-spinner'
import routes from './router.js';

 window.Vue.use(VueSwal)
 window.Vue.use(Spinner)

 Vue.component('pagination', require('laravel-vue-pagination'));
 Vue.component('vue-simple-spinner', require('vue-simple-spinner'))

 window.Vue.use(VueRouter);


 const router =  new VueRouter({routes})
 const app = new Vue ({router}).$mount('#app')