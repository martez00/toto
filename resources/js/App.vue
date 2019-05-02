<template>
    <div>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
            <h5 class="my-0 mr-md-auto font-weight-normal"><router-link :to="{ name: 'home' }">Lietuvos futbolo totalizatorius</router-link></h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" v-if="$auth.check()" v-for="(route, key) in routes.user" v-bind:key="route.path"><router-link  :to="{ name : route.path }" :key="key">
                    {{route.name}}
                </router-link></a>
                <a class="p-2 text-dark" v-if="$auth.check(1)" v-for="(route, key) in routes.admin" v-bind:key="route.path"> <router-link  :to="{ name : route.path }" :key="key">
                    {{route.name}}
                </router-link></a>
            </nav>
            <a class="btn btn-outline-primary" v-if="!$auth.check()"><router-link :to="{ name: 'login' }">Prisijungti</router-link></a>
            <a class="btn btn-outline-primary" v-if="$auth.check()" @click.prevent="$auth.logout()">Atsijungti</a>
        </div>
    <div class="container">
            <router-view></router-view>
    </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                routes: {
                    // LOGGED USER
                    user: [
                        {
                            name: 'Mano profilis',
                            path: 'dashboard'
                        }
                    ],
                    // LOGGED ADMIN
                    admin: [
                        {
                            name: 'Administravimo panelė',
                            path: 'admin.dashboard'
                        }
                    ]
                }
            }
        },
        mounted() {
            //
        }
    }
</script>