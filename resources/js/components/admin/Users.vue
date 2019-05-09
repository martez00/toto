<template>
    <div class="container">
        <BackModal/>
        <div class="card card-default box-shadow">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link disabled active">Vartotojai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:#007bff; cursor: pointer" @click="showModal">Pridėti naują vartotoją</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
        <div class="alert alert-danger" v-if="has_error">
            <p>Klaida! Nepavyko gauti vartotojų sąrašo.</p>
        </div>
                <CreateUser v-show="isModalVisible" @close="closeModal"/>
                <UserDeleteConfirmationModal :user="selectedUser" v-if="confirmModal" @confirm="deleteUser" @cancel="cancelDelete"/>
                <UserEditModal :user="selectedEditUser" v-if="editModalvisible" @confirm="storeEditedUser" @close="closeEditModal"/>
                <div class="table-responsive text-nowrap">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Vartotojo vardas</th>
                            <th scope="col">El. paštas</th>
                            <th scope="col">Registracijos data</th>
                            <th scope="col">Veiksmai</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(user, index) in users" v-bind:index="index" v-bind:key="user.id" style="margin-bottom: 5px;">
                            <th scope="row" style="vertical-align:middle">{{ user.id }}</th>
                            <td style="vertical-align:middle">{{ user.name }}</td>
                            <td style="vertical-align:middle">{{ user.email }}</td>
                            <td style="vertical-align:middle">{{ user.created_at}}</td>
                            <td style="vertical-align:middle"><button type="button" class="btn btn-sm pointer-event" @click="confirmDelete(user)"><img :src="images.delete" class="delete_button"></button><button @click="showEditModal(user)" class="btn btn-sm"><img :src="images.edit" class="delete_button"></button></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <Pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="getUsers()"/>
    </div>
        </div>
    </div>
</template>
<script>
    import CreateUser from './CreateUser.vue';
    import UserDeleteConfirmationModal from './UserDeleteConfirmationModal.vue';
    import UserEditModal from './UserEditModal.vue';
    import BackModal from '../Back.vue';
    import Pagination from '../system/PaginationComponent.vue';
    let axios = require('axios');
    export default {
        data() {
            return {
                has_error: false,
                users: [],
                isModalVisible: false,
                confirmModal: false,
                editModalvisible: false,
                selectedUser: null,
                selectedEditUser: null,
                pagination: {
                    'current_page': 1,
                    'last_page': null
                },
                images: {
                    delete: require('../../../../storage/app/public/images/system/delete.png'),
                    edit: require('../../../../storage/app/public/images/system/edit.png')
                }
            }
        },
        components: {
            CreateUser,
            UserDeleteConfirmationModal,
            UserEditModal,
            BackModal,
            Pagination,
        },
        mounted() {
            this.getUsers();
        },
        methods: {
            getUsers() {
                axios.get('users?page=' + this.pagination.current_page)
                    .then(response => {
                        this.users = response.data.data.data;
                        this.pagination = response.data.pagination;
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            },
            confirmDelete(u, index) {
                this.selectedUser = u;
                this.confirmModal = true;
            },
            cancelDelete() {
                this.confirmModal = false;
                this.selectedUser = null;
            },
            deleteUser() {
                let tmp_id=this.selectedUser.id;
                this.$http({
                    url: 'user/'+tmp_id,
                    method: 'DELETE'
                })
                    .then(response => {
                        this.getUsers();
                    });
                this.selectedUser = null;
                this.confirmModal = false;
            },
            showModal() {
                this.isModalVisible = true;
            },
            closeModal() {
                this.isModalVisible = false;
                this.getUsers();
            },
            showEditModal(user) {
                this.selectedEditUser = user;
                this.editModalvisible = true;
            },
            closeEditModal() {
                this.selectedEditUser = null;
                this.editModalvisible = false;
            },
            storeEditedUser(user){
                this.selectedEditUser = null;
                this.editModalvisible = false;
                axios.post('user/' + user.id, {
                    name: user.name,
                    email: user.email
                })
                    .then(response => {
                        console.log(response);
                    })
                    .catch(e => {
                        console.log(e);
                    });
            }
        }
    }
</script>
