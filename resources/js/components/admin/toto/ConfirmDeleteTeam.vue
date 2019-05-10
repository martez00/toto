<template>
    <transition name="TeamDeleteConfirmation">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <slot name="header">
                            <b>Komandos ištrynimo patvirtinimas</b>
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            <p>Ar tikrai norite ištrinti komandą <strong>{{ item.name }}</strong>?</p>
                        </slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            <button class="btn btn-sm btn-warning" @click="onCancel">Neištrinti komandos</button>
                            <button class="btn btn-sm btn-danger" @click="onConfirm">Ištrinti komandą</button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
    export default {
        props: ["open", "item"],
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