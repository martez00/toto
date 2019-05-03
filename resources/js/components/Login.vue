<template>
    <div>
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Prisijungimas prie sistemos</h5>
                        <form autocomplete="off" @submit.prevent="login" method="post">
                            <div class="form-group">
                                <label for="email">El. paštas</label>
                                <input type="email" id="email" class="form-control" placeholder="Email address" v-model="email" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="password">Slaptažodis</label>
                                <input type="password" id="password" class="form-control" placeholder="Password" v-model="password" required>
                            </div>
                            <hr class="my-4">
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Prisijungti</button>
                            <center><router-link :to="{ name: 'register' }">Dar neturi susikūręs vartotojo? Užsiregistruok!</router-link></center>
                        </form>
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
                email: null,
                password: null,
                has_error: false
            }
        },
        mounted() {
            //
        },
        methods: {
            login() {
                // get the redirect object
                var redirect = this.$auth.redirect()
                var app = this
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password
                    },
                    success: function() {
                        // handle redirection
                        const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 1 ? 'admin.dashboard' : 'dashboard'
                        this.$router.push({name: redirectTo})
                    },
                    error: function() {
                        app.has_error = true;
                        this.$toastr.e("Vartotojas su Jūsų įvestais prisijungimo duomenimis neegzistuoja!");
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            }
        }
    }
</script>
