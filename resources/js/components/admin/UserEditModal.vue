<template>
    <transition name="CreateUser">
        <div class="modal-mask">
            <div class="modal-wrapper">
                    <div class="modal-container">
                        <form autocomplete="off" @submit.prevent="updateUser" method="post">
                        <div class="modal-header">
                            <slot name="header">
                                <b>Vartotojo redagavimas</b>
                                <button type="button" style="float:right" class="close" data-dismiss="modal" @click="close">&times;</button>
                            </slot>
                        </div>

                        <div class="modal-body">
                            <slot name="body">
                                <div class="form-group" v-bind:class="{ 'has-error': error && errors.name }">
                                    <label for="name">Vartotojo vardas</label>
                                    <input type="text" ref="update_name" id="name" v-bind:value="user.name"  class="form-control" required>
                                    <span class="help-block" v-if="error && errors.name">{{ errors.name }}</span>
                                </div>
                                <div class="form-group" v-bind:class="{ 'has-error': error && errors.email }">
                                    <label for="email">El. paštas</label>
                                    <input type="email" ref="update_email" id="email" v-bind:value="user.email" class="form-control" placeholder="vartotojas@pavyzdys.com" required>
                                    <span class="help-block" v-if="error && errors.email">{{ errors.email }}</span>
                                </div>
                            </slot>
                        </div>

                        <div class="modal-footer">
                            <slot name="footer">
                                <button class="btn btn-lg btn-success btn-block text-uppercase" type="submit">IŠSAUGOTI</button>
                            </slot>
                        </div>
                        </form>
                    </div>
            </div>
        </div>
    </transition>
</template>
<script>
    export default {
        name: 'UserEditModal',
        props: ["open", "user"],
        data(){
            return {
                error: false,
                errors: {},
                success: false
            };
        },
        methods: {
            close(){
                this.$emit('close');
            },
            updateUser() {
                this.user.name=this.$refs['update_name'].value;
                this.user.email=this.$refs['update_email'].value;
                this.$emit('confirm', this.user);
            }
        },
    };
</script>