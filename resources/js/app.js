import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

try {
    require('bootstrap');
} catch (e) { }

import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './router';
import Toasted from 'vue-toasted';

Vue.use(Toasted)
Vue.use(VueRouter);

window.Vue = require('vue').default;
Vue.component('navigation', require('./components/Nav.vue').default);

const app = new Vue({
    el: '#oji',
    router: new VueRouter(routes),
});
