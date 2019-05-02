import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import VueAuth from '@websanova/vue-auth'
import App from './App.vue';
import UserDashboard from './components/user/Dashboard.vue';
import AdminDashboard from './components/admin/Dashboard.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import auth from './auth'
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
import axios from 'axios';
axios.defaults.baseURL = 'http://toto.test/api';
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
        },]
});
Vue.router = router
Vue.use(VueAuth, auth);
App.router = Vue.router
new Vue(App).$mount('#app');
