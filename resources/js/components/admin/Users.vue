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
                        <tr v-for="(user, index) in sortedUsers" v-bind:index="index" v-bind:key="user.id" style="margin-bottom: 5px;">
                            <th scope="row" style="vertical-align:middle">{{ user.id }}</th>
                            <td style="vertical-align:middle">{{ user.name }}</td>
                            <td style="vertical-align:middle">{{ user.email }}</td>
                            <td style="vertical-align:middle">{{ user.created_at}}</td>
                            <td style="vertical-align:middle"><button type="button" class="btn btn-sm pointer-event" @click="confirmDelete(user)"><img :src="images.delete" class="delete_button"></button><button @click="showEditModal(user)" class="btn btn-sm"><img :src="images.edit" class="delete_button"></button></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div  v-if="users.length>20">
                   <center><button  class="btn btn-primary btn-sm" @click="prevPage">Praėjęs</button>
                    <button  class="btn btn-primary btn-sm" @click="nextPage">Kitas</button></center>
                </div>
    </div>
        </div>
    </div>
</template>
<script>
    import CreateUser from './CreateUser.vue';
    import UserDeleteConfirmationModal from './UserDeleteConfirmationModal.vue';
    import UserEditModal from './UserEditModal.vue';
    import BackModal from '../Back.vue';
    let axios = require('axios');
    export default {
        data() {
            return {
                has_error: false,
                users: [],
                pageSize:20,
                currentPage:1,
                isModalVisible: false,
                confirmModal: false,
                editModalvisible: false,
                selectedUser: null,
                selectedEditUser: null,
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
        },
        mounted() {
            this.getUsers();
        },
        methods: {
            getUsers() {
                this.$http({
                    url: 'users',
                    method: 'GET'
                })
                    .then((res) => {
                        this.users = res.data.users
                    }, () => {
                        this.has_error = true
                    })
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
                        const index = this.users.findIndex(user => user.id === tmp_id); // find the post index
                        if (~index) // if the post exists in array
                            this.users.splice(index, 1) //delete the post
                    });
                this.selectedUser = null;
                this.confirmModal = false;
            },
            nextPage:function() {
                if((this.currentPage*this.pageSize) < this.users.length) this.currentPage++;
            },
            prevPage:function() {
                if(this.currentPage > 1) this.currentPage--;
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
        },
        computed: {
            sortedUsers: function () {
                return this.users.filter((row, index) => {
                    let start = (this.currentPage - 1) * this.pageSize;
                    let end = this.currentPage * this.pageSize;
                    if (index >= start && index < end) return true;
                });
            }
        }
    }
</script>
