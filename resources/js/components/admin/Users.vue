<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header"><router-link :to="{ name: 'admin.dashboard' }">SISTEMOS ADMINISTRAVIMAS</router-link> -> VARTOTOJŲ ADMINISTRAVIMAS</div>
            <div class="card-body">
        <div class="alert alert-danger" v-if="has_error">
            <p>Klaida! Nepavyko gauti vartotojų sąrašo.</p>
        </div>
                <button type="button" class="btn btn-primary btn-sm" style="margin-bottom:5px;" @click="showModal">Pridėti naują vartotoją</button>
                <CreateUser v-show="isModalVisible" @close="closeModal"/>
        <table class="table">
            <tr>
                <th scope="col"></th>
                <th scope="col">ID</th>
                <th scope="col">Vartotojo vardas</th>
                <th scope="col">El. paštas</th>
                <th scope="col">Registracijos data</th>
            </tr>
            <tr v-for="(user, index) in sortedUsers" v-bind:index="index" v-bind:key="user.id" style="margin-bottom: 5px;">
                <td><button type="button" class="btn btn-danger btn-sm" @click="deleteData(user.id, index)">X</button></td>
                <th scope="row">{{ user.id }}</th>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.created_at}}</td>
            </tr>
        </table>
                <div  v-if="users.length>20">
                   <center><button  class="btn btn-primary btn-sm" @click="prevPage">Previous</button>
                    <button  class="btn btn-primary btn-sm" @click="nextPage">Next</button></center>
                </div>
    </div>
        </div>
    </div>
</template>
<script>
    import CreateUser from './CreateUser.vue';
    export default {
        data() {
            return {
                has_error: false,
                users: [],
                pageSize:20,
                currentPage:1,
                isModalVisible: false
            }
        },
        components: {
            CreateUser,
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
            deleteData: function(id, index) {
                this.$http({
                    url: 'user/'+id,
                    method: 'DELETE'
                })
                    .then(response => {
                        this.users.splice(index, 1);
                    });
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