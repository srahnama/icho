
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Example from './components/Example.vue';
import Message from './components/Message.vue';
import User from './components/Users.vue';
require('./bootstrap');
// window.Vue = require('vue');
// var Vue = require('vue');
Vue.http.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
const app = new Vue({
    el: '#app',
    components:{
        Example,Message,User
    }
});
