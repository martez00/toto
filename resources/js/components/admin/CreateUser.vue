<template>
    <transition name="CreateUser">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                <div class="modal-container">

                    <div class="modal-header">
                        <slot name="header">
                            <b>Naujo vartotojo pridėjimas</b>
                            <button type="button" style="float:right" class="close" data-dismiss="modal" @click="close">&times;</button>
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                                <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                                    <label for="name">Vartotojo vardas</label>
                                    <input type="text" id="name" class="form-control" v-model="name" required>
                                    <span class="help-block" v-if="error && errors.name">{{ errors.name }}</span>
                                </div>
                                <div class="form-group" v-bind:class="{ 'has-error': error && errors.email }">
                                    <label for="email">El. paštas</label>
                                    <input type="email" id="email" class="form-control" placeholder="vartotojas@pavyzdys.com" v-model="email" required>
                                    <span class="help-block" v-if="error && errors.email">{{ errors.email }}</span>
                                </div>
                                <div class="form-group" v-bind:class="{ 'has-error': error && errors.password }">
                                    <label for="password">Slaptažodis</label>
                                    <input type="password" id="password" class="form-control" v-model="password" required>
                                    <span class="help-block" v-if="error && errors.password">{{ errors.password }}</span>
                                </div>
                        </slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">SUKURTI VARTOTOJĄ</button>
                        </slot>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </transition>
</template>
<script>
    export default {
        name: 'CreateUser',
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
                        app.success = true;
                        this.$emit('close');
                    },
                    error: function (resp) {
                        app.error = true;
                        app.errors = resp.response.data.errors;
                    },
                    redirect: null
                });
            },
            close(){
                this.$emit('close');
            }
        },
    };
</script>