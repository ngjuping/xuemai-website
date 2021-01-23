
import Vue from 'vue';
import VueRouter from 'vue-router';
import AllPosts from '../components/AllPosts.vue'

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'AllPosts',
        component: AllPosts
    }]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router;
