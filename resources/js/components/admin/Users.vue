<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header"><router-link :to="{ name: 'admin.dashboard' }">SISTEMOS ADMINISTRAVIMAS</router-link> -> VARTOTOJŲ ADMINISTRAVIMAS</div>
            <div class="card-body">
        <div class="alert alert-danger" v-if="has_error">
            <p>Klaida! Nepavyko gauti vartotojų sąrašo.</p>
        </div>
        <table class="table">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Vartotojo vardas</th>
                <th scope="col">El. paštas</th>
                <th scope="col">Registracijos data</th>
            </tr>
            <tr v-for="user in sortedUsers" v-bind:key="user.id" style="margin-bottom: 5px;">
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
    export default {
        data() {
            return {
                has_error: false,
                users: [],
                pageSize:20,
                currentPage:1
            }
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
            nextPage:function() {
                if((this.currentPage*this.pageSize) < this.users.length) this.currentPage++;
            },
            prevPage:function() {
                if(this.currentPage > 1) this.currentPage--;
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