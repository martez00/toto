<template>
    <div>
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Naujo vartotojo registracija</h5>
                        <div class="alert alert-danger" v-if="error && !success">
                            <p>Įvyko klaida! Negalima užbaigti registracijos.</p>
                        </div>
                        <div class="alert alert-success" v-if="success">
                            <p>Registracija užbaigta sėkmingai! Dabar galite <router-link :to="{name:'login'}">prisijungti.</router-link></p>
                        </div>
                        <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                            <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" v-model="name" required>
                                <span class="help-block" v-if="error && errors.name">{{ errors.name }}</span>
                            </div>
                            <div class="form-group" v-bind:class="{ 'has-error': error && errors.email }">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                                <span class="help-block" v-if="error && errors.email">{{ errors.email }}</span>
                            </div>
                            <div class="form-group" v-bind:class="{ 'has-error': error && errors.password }">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control" v-model="password" required>
                                <span class="help-block" v-if="error && errors.password">{{ errors.password }}</span>
                            </div>
                            <hr class="my-4">
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">REGISTRUOTIS</button>
                            <center><router-link :to="{ name: 'login' }">Jau esi užsiregistravęs? Prisijunk!</router-link></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                name: '',
                email: '',
                password: '',
                error: false,
                errors: {},
                success: false
            };
        },
        methods: {
            register(){
                var app = this
                this.$auth.register({
                    data: {
                        name: app.name,
                        email: app.email,
                        password: app.password
                    },
                    success: function () {
                        app.success = true
                    },
                    error: function (resp) {
                        app.error = true;
                        app.errors = resp.response.data.errors;
                    },
                    redirect: null
                });
            }
        }
    }
</script>
