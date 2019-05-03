<template>
    <div style="width:100%;">
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
            <h5 class="my-0 mr-md-auto font-weight-normal"><router-link :to="{ name: 'home' }">Lietuvos futbolo totalizatorius</router-link></h5>
            <router-link :to="{ name: 'login' }" v-if="!$auth.check()"><a class="btn btn-outline-primary">Prisijungti</a></router-link>
            <div class="btn-group" v-if="$auth.check()">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $auth.user().name }}
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <router-link  :to="{ name : route.path }" :key="key" v-if="$auth.check()" v-for="(route, key) in routes.user" v-bind:key="route.path"><a class="dropdown-item">
                        {{route.name}}
                    </a></router-link>
                    <router-link  :to="{ name : route.path }" :key="key"  v-if="$auth.check(1)" v-for="(route, key) in routes.admin" v-bind:key="route.path"><a class="dropdown-item">
                        {{route.name}}
                    </a></router-link>
                    <a class="dropdown-item" v-if="$auth.check()" @click.prevent="$auth.logout()">Atsijungti</a>
                </div>
            </div>
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
                            name: 'Sistemos administravimas',
                            path: 'admin.dashboard'
                        }
                    ]
                }
            }
        },
        mounted() {
        }
    }
</script>