<template>
    <div class="container container_margin">
        <BackModal/>
        <div class="card card-default box-shadow">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link disabled active">Įrašai</a>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{ name: 'admin.createpost' }"><a class="nav-link" style="color:#007bff; cursor: pointer">Pridėti naują įrašą</a></router-link>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error">
                    <p>Klaida! Nepavyko gauti įrašų sąrašo.</p>
                </div>
                <ConfirmDeletePost :post="selectedPostDelete" v-if="confirmDeleteModal" @confirm="deletePost" @cancel="cancelDelete"/>
                <div class="table-responsive text-nowrap">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Pavadinimas</th>
                            <th scope="col">Kas sukūrė</th>
                            <th scope="col">Registracijos data</th>
                            <th scope="col">Veiksmai</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(post, index) in posts" v-bind:index="index" v-bind:key="post.id" style="margin-bottom: 5px;">
                            <th scope="row" style="vertical-align:middle">{{ post.id }}</th>
                            <td style="vertical-align:middle">{{ post.title }}</td>
                            <td style="vertical-align:middle">{{ post.user.name }}</td>
                            <td style="vertical-align:middle">{{ post.created_at}}</td>
                            <td style="vertical-align:middle"><button type="button" class="btn btn-sm pointer-event" @click="confirmDelete(post)"><img :src="images.delete" class="delete_button"></button><button @click="showEditModal(user)" class="btn btn-sm"><img :src="images.edit" class="delete_button"></button></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <Pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="getPosts()"/>
            </div>
        </div>
    </div>
</template>

<script>
    import BackModal from '../../Back.vue';
    import ConfirmDeletePost from './ConfirmDeletePost.vue';
    import Pagination from '../../system/PaginationComponent.vue';
    let axios = require('axios');
    export default {
        name: "Posts",
        data() {
            return {
                has_error: false,
                posts: [],
                selectedPostDelete: null,
                confirmDeleteModal: false,
                pagination: {
                    'current_page': 1,
                    'last_page': null
                },
                images: {
                    delete: require('../../../../../storage/app/public/images/system/delete.png'),
                    edit: require('../../../../../storage/app/public/images/system/edit.png')
                }
            }
        },
        mounted() {
            this.getPosts();
        },
        methods: {
            getPosts() {
                axios.get('posts?page=' + this.pagination.current_page)
                    .then(response => {
                        this.posts = response.data.data.data;
                        this.pagination = response.data.pagination;
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            },
            confirmDelete(post) {
                this.selectedPostDelete = post;
                this.confirmDeleteModal = true;
            },
            cancelDelete() {
                this.selectedPostDelete = null;
                this.confirmDeleteModal = false;
            },
            deletePost() {
                let tmp_id=this.selectedPostDelete.id;
                axios.delete('post/'+tmp_id)
                    .then(res => {
                        this.getPosts();
                    })
                    .catch(e => {
                        console.log(e);
                        this.has_error = true;
                    });
                this.selectedPostDelete = null;
                this.confirmDeleteModal = false;
            }
        },
        components: {
            BackModal,
            ConfirmDeletePost,
            Pagination
        }
    }
</script>