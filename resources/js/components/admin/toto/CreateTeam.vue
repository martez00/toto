<template>
    <div class="container container_margin">
        <BackModal/>
        <div class="card card-default box-shadow">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link disabled active">Naujo įrašo sukūrimas</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error">
                    Klaida! Nepavyko sukurti įrašo.
                </div>
                <div class="alert alert-success" v-if="created_succesfully">
                    Jūsų <strong>{{created_item}}</strong> įrašas sukurtas sėkmingai!
                </div>
                <form autocomplete="off" @submit.prevent="create_post" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name"><b>Pavadinimas</b></label>
                        <input type="text" id="name" class="form-control" placeholder="Komandos pavadinimas" v-model="name" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="short_name"><b>Trumpas pavadinimas</b></label>
                        <input type="text" id="short_name" class="form-control" placeholder="Trumpas komandos pavadinimas (pvz. FCB)" v-model="short_name" required autofocus>
                    </div>
                    <div class="form-group">
                        <label ><b>Komandos logotipas</b></label>
                        <input type="file" id="image" ref="image" v-on:change="handleFileUpload()"/>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Išsaugoti naują komandą</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import BackModal from '../../Back.vue';
    let axios = require('axios');
    export default {
        name: "CreateTeam",
        data(){
            return {
                has_error:false,
                name: '',
                short_name: '',
                image: '',
                created_succesfully: false,
                created_item: null,
            }
        },
        methods: {
            create_post(){
                let postData = new FormData();
                postData.append('image', this.image);
                postData.append('name', this.name);
                postData.append('short_name', this.short_name);
                axios.post('teams', postData, {
                    headers: { 'Content-Type': 'multipart/form-data' },
                })
                    .then(res => {
                        console.log(res);
                        this.created_succesfully = true;
                        this.created_item = res.data.data.name;
                        this.name='';
                        this.short_name='';
                        this.image='';
                    })
                    .catch(e => {
                        console.log(e);
                        this.created_succesfully=false;
                        this.has_error = true;
                    });
            },
            handleFileUpload(){
                this.image = this.$refs.image.files[0];
            }
        },
        components: {
            BackModal,
        }
    }
</script>
<style scoped>

</style>