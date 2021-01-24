
import Vue from 'vue';
import VueRouter from 'vue-router';
import BlogMain from '../components/BlogMain.vue'
import PostDetail from '../components/PostDetail.vue'

// without this line vue is not reactive??? experimented
Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'BlogMain',
        component: BlogMain
    },
    {
        path: '/post/:id',
        name: 'PostDetail',
        component: PostDetail
    }]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router;
