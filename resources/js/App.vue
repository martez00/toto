<template>
    <div>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
            <h5 class="my-0 mr-md-auto font-weight-normal"><router-link :to="{ name: 'home' }">ToTo</router-link></h5>
            <nav class="my-2 my-md-0 mr-md-3">

            </nav>
            <a class="btn btn-outline-primary" v-if="!$auth.check()"><router-link :to="{ name: 'login' }">Prisijungti</router-link></a>
            <a class="btn btn-outline-primary" v-if="$auth.check()" @click.prevent="$auth.logout()">Atsijungti</a>
        </div>
    <div class="container">
            <router-view></router-view>
    </div>
    </div>
</template>