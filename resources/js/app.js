// Register some global functions such as $ from jquery
require('./bootstrap');

window.Vue = require('vue').default;

// vue router, independent from laravel routing
 import router from './router';

// import store from './store';

// fake response server, can be used for quick frontend development without needing backend
// import { makeServer } from "./server";
// makeServer();

// import top level vue app components
import App from './App.vue';
import Admin from './Admin.vue';
import 'v-markdown-editor/dist/v-markdown-editor.css';
import Editor from 'v-markdown-editor';

// global register markdown editor
Vue.use(Editor);

// register global components
Vue.component('app',App);
Vue.component('admin',Admin);


var app = new Vue({
    router,
    el: '#app',
});


require('alpinejs'); //for tailwindcss
