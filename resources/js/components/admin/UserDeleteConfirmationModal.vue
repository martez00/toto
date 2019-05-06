<template>
    <transition name="UserDeleteConfirmation">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <slot name="header">
                            <b>Vartotojo ištrynimo patvirtinimas</b>
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            <p>Ar tikrai norite ištrinti vartotoją <strong>{{ user.name }}</strong>?</p>
                        </slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            <button class="btn btn-sm btn-warning" @click="onCancel">Neištrinti vartotojo</button>
                            <button class="btn btn-sm btn-danger" @click="onConfirm">Ištrinti vartotoją</button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
    export default {
        props: ["open", "user"],
        methods: {
            onConfirm() {
                this.$emit("confirm");
            },
            onCancel() {
                this.$emit("cancel");
            }
        },
    };
</script>