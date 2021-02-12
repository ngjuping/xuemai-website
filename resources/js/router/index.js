
import Vue from 'vue';
import VueRouter from 'vue-router';
import BlogMain from '../pages/BlogMain.vue';
import PostDetail from '../components/PostDetail.vue';
import About from "../pages/About";
import Contact from "../pages/Contact";
import FAQ from "../pages/FAQ";

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
    },
    {
        path: '/about',
        name: 'About',
        component: About
    },
    {
        path: '/contact',
        name: 'Contact',
        component: Contact
    },
    {
        path: '/faq',
        name: 'FAQ',
        component: FAQ
    },
]

const router = new VueRouter({
    mode: 'history',
    routes
})

export default router;
