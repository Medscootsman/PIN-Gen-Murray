require('./bootstrap');
const Axios = require('axios');

const Vue = require('vue').default;

Vue.component('pin-number', require('./components/PinNumber.vue').default);

const app = new Vue({
    el: '#app',
})