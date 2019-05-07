import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import VueAuth from '@websanova/vue-auth'
import App from './App.vue';
import UserDashboard from './components/user/Dashboard.vue';
import AdminDashboard from './components/admin/Dashboard.vue';
import AdminUsers from './components/admin/Users.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Page403 from './components/Page403.vue';
import AdminPosts from './components/admin/posts/Posts.vue';
import AdminCreatePost from './components/admin/posts/CreatePost.vue';
import Toastr from 'vue-toastr';
import CKEditor from '@ckeditor/ckeditor5-vue';
// import toastr scss file: need webpack sass-loader
require('vue-toastr/src/vue-toastr.scss');
import auth from './auth'
Vue.use(CKEditor);
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
import axios from 'axios'
axios.defaults.baseURL = '/api';
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {
                auth: undefined
            }
        },
        {
            path: '/403',
            name: 'Page403',
            component: Page403,
            meta: {
                auth: undefined
            }
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            meta: {
                auth: false
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                auth: false
            }
        },
        // USER ROUTES
        {
            path: '/dashboard',
            name: 'dashboard',
            component: UserDashboard,
            meta: {
                auth: true
            }
        },
        // ADMIN ROUTES
        {
            path: '/admin',
            name: 'admin.dashboard',
            component: AdminDashboard,
            meta: {
                auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
            }
        },
        {
            path: '/users',
            name: 'admin.users',
            component: AdminUsers,
            meta: {
                auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
            }
        },
        {
            path: '/posts',
            name: 'admin.posts',
            component: AdminPosts,
            meta: {
                auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
            }
        },
        {
            path: '/posts/create',
            name: 'admin.createpost',
            component: AdminCreatePost,
            meta: {
                auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
            }
        },
    ]
});
Vue.router = router
Vue.use(VueAuth, auth);
// Register plugin
Vue.use(Toastr, { defaultPosition: "toast-top-center" });
App.router = Vue.router
new Vue(App).$mount('#app');
