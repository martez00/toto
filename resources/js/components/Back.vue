<template>
    <div>
        <center><a @click="$router.go(-1)" class="btn btn-sm btn-outline-primary " style="margin-bottom:5px; cursor: pointer"><img :src="images.back" class="delete_button"> ATGAL</a></center>
    </div>
</template>

<script>
    export default {
        name: "Back",
        data() {
            return {
                images: {
                    back: require('../../../storage/app/public/images/system/back.png')
                }
            }
        }
    }
</script>
