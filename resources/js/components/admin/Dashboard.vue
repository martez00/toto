<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">SISTEMOS ADMINISTRAVIMAS</div>
            <div class="card-body">
                <div class="card-deck mb-3 text-center">
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">VARTOTOJAI</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">{{ users_count }} <small class="text-muted">vartotojai (-ų)</small></h1>
                            <router-link :to="{ name: 'admin.users' }"><button type="button" class="btn btn-lg btn-block btn-primary">ADMINISTRAVIMAS</button></router-link>
                        </div>
                    </div>
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Pro</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mo</small></h1>
                            <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
                        </div>
                    </div>
                    <div class="card mb-4 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Enterprise</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mo</small></h1>
                            <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
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