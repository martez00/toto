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
                            <h5 class="card-title">{{ 1234 }} <small class="text-muted">kažko (-ų)</small></h5>
                            <router-link :to="{ name: 'admin.users' }"><button type="button" class="btn btn-sm btn-block btn-primary">ADMINISTRAVIMAS</button></router-link>
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
    export default {
        components: {
            BackModal,
        },
        data() {
            return {
                has_error: false,
                users_count: null
            }
        },

        mounted() {
            this.getUsersCount();
        },

        methods: {
            getUsersCount() {
                this.$http({
                    url: 'users',
                    method: 'GET'
                })
                    .then((res) => {
                        this.users_count = res.data.users.length
                    }, () => {
                        this.has_error = true
                    })
            }
        }
    }

</script>
