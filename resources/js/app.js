// Register some global functions such as $ from jquery
require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';

// without this line vue is not reactive??? experimented
Vue.use(VueRouter);

// vue router, independent from laravel routing
// import router from './router';
// import store from './store';

// fake response server, can be used for quick frontend development without needing backend
// import { makeServer } from "./server";
// makeServer();

// import top level vue app components
import App from './App.vue';
import Admin from './Admin.vue';
import BlogMain from './components/BlogMain.vue';

// register global components
Vue.component('blog',BlogMain);
Vue.component('app',App);
Vue.component('admin',Admin);

var app = new Vue({
    el: '#app',
});

require('alpinejs'); //for tailwindcss
