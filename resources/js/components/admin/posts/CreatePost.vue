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
                    Jūsų <strong>{{created_post}}</strong> įrašas sukurtas sėkmingai!
                </div>
                <form autocomplete="off" @submit.prevent="create_post" method="post">
                <div class="form-group">
                    <label for="title"><b>Pavadinimas</b></label>
                    <input type="text" id="title" class="form-control" placeholder="Jūsų įrašo pavadinimas" v-model="title" required autofocus>
                </div>
                <div class="form-group">
                    <label for="caption"><b>Pradinė įžanga</b></label>
                    <textarea id="caption" class="form-control" placeholder="Trumpa įžanga į naujieną matoma pagrindiniame sistemos lange" v-model="caption"></textarea>
                </div>
                <div class="form-group">
                    <label ><b>Įrašo tekstas</b></label>
                    <ckeditor :editor="editor" id="body" v-model="body"></ckeditor>
                </div>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Išsaugoti naują įrašą</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import BackModal from '../../Back.vue';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    let axios = require('axios');
    export default {
        name: "CreatePost",
        data(){
            return {
                has_error:false,
                editor: ClassicEditor,
                title: '',
                caption: '',
                body: '',
                created_succesfully: false,
                created_post: null,
            }
        },
        methods: {
          create_post(){
              axios.post('posts', {
                  title: this.title,
                  caption: this.caption,
                  body: this.body
              })
                  .then(res => {
                      console.log(res);
                      this.created_succesfully = true;
                      this.created_post = res.data.data.title;
                      this.title='';
                      this.caption='';
                      this.body='';
                  })
                  .catch(e => {
                      console.log(e);
                      this.created_succesfully=false;
                      this.has_error = true;
                  });
          }
        },
        components: {
            BackModal,
        }
    }
</script>
<style scoped>

</style>