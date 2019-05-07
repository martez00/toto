<template>
    <transition name="PostDeleteConfirmation">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <slot name="header">
                            <b>Įrašo ištrynimo patvirtinimas</b>
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            <p>Ar tikrai norite ištrinti įrašą <strong>{{ post.title }}</strong>?</p>
                        </slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            <button class="btn btn-sm btn-warning" @click="onCancel">Neištrinti įrašo</button>
                            <button class="btn btn-sm btn-danger" @click="onConfirm">Ištrinti įrašą</button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
    export default {
        props: ["open", "post"],
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