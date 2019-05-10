<template>
    <div class="container">
        <BackModal/>
        <div class="card card-default box-shadow">
            <div class="card-header">Sistemos administravimas</div>
            <div class="card-body">
                <div class="card-deck mb-sm-0 text-center">
                    <div class="card mb-sm-4">
                        <div class="card-header">
                            <h6 class="my-sm-0 font-weight-normal"><b>Vartotojai</b></h6>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ users_count }} <small class="text-muted">vartotojai (-ų)</small></h5>
                            <router-link :to="{ name: 'admin.users' }"><button type="button" class="btn btn-sm btn-block btn-primary">ADMINISTRAVIMAS</button></router-link>
                        </div>
                    </div>
                    <div class="card mb-sm-4">
                        <div class="card-header">
                            <h6 class="my-sm-0 font-weight-normal"><b>Įrašai</b></h6>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ posts_count }} <small class="text-muted">įrašai (-ų)</small></h5>
                            <router-link :to="{ name: 'admin.posts' }"><button type="button" class="btn btn-sm btn-block btn-primary">ADMINISTRAVIMAS</button></router-link>
                        </div>
                    </div>
                    <div class="card mb-sm-4">
                        <div class="card-header">
                            <h6 class="my-sm-0 font-weight-normal"><b>Komandos</b></h6>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ teams_count }} <small class="text-muted">komandos (-ų)</small></h5>
                            <router-link :to="{ name: 'admin.teams' }"><button type="button" class="btn btn-sm btn-block btn-primary">ADMINISTRAVIMAS</button></router-link>
                        </div>
                    </div>
                    <div class="card mb-sm-4">
                        <div class="card-header">
                            <h6 class="my-sm-0 font-weight-normal"><b>Kažkas</b></h6>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ 1234 }} <small class="text-muted">kažko (-ų)</small></h5>
                            <router-link :to="{ name: 'admin.users' }"><button type="button" class="btn btn-sm btn-block btn-primary">ADMINISTRAVIMAS</button></router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import BackModal from '../Back.vue';
    let axios = require('axios');
    export default {
        components: {
            BackModal,
        },
        data() {
            return {
                has_error: false,
                users_count: 0,
                posts_count: 0,
                teams_count: 0,
            }
        },

        mounted() {
            this.getUsersCount();
            this.getPostsCount();
            this.getTeamsCount();
        },

        methods: {
            getUsersCount() {
                axios.get('users', {
                    params: {
                        return_users_count: 1
                    }
                })
                    .then((res) => {
                            this.users_count = res.data.users_count;
                    }, () => {
                        this.has_error = true;
                    })
            },
            getPostsCount() {
                axios.get('posts', {
                    params: {
                        return_post_count: 1
                    }
                })
                    .then(res => {
                        this.posts_count = res.data.posts_count;
                    })
                    .catch(e => {
                        this.has_error = true;
                    });
            },
            getTeamsCount() {
                axios.get('teams', {
                    params: {
                        return_team_count: 1
                    }
                })
                    .then(res => {
                        this.teams_count = res.data.teams_count;
                    })
                    .catch(e => {
                        this.has_error = true;
                    });
            }
        }
    }

</script>
