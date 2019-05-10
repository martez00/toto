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
                        <router-link :to="{ name: 'admin.createteam' }"><a class="nav-link" style="color:#007bff; cursor: pointer">Pridėti naują komandą</a></router-link>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error">
                    <p>Klaida! Nepavyko gauti komandų sąrašo.</p>
                </div>
                <ConfirmDeleteTeam :item="selectedItemDelete" v-if="confirmDeleteModal" @confirm="deleteItem" @cancel="cancelDelete"/>
                <div class="table-responsive text-nowrap">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col"></th>
                            <th scope="col">Trumpinys</th>
                            <th scope="col">Pilnas pavadinimas</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(team, index) in teams" v-bind:index="index" v-bind:key="team.id" style="margin-bottom: 5px;">
                            <th scope="row" style="vertical-align:middle">{{ team.id }}</th>
                            <td style="vertical-align:middle"><img :src="'storage/images/team_images/'+team.image" style="height:20px"></td>
                            <td style="vertical-align:middle"><b>{{ team.short_name }}</b></td>
                            <td style="vertical-align:middle">{{ team.name}}</td>
                            <td style="vertical-align:middle"><button type="button" class="btn btn-sm pointer-event" @click="confirmDelete(team)"><img :src="images.delete" class="delete_button"></button><button @click="showEditModal(team)" class="btn btn-sm"><img :src="images.edit" class="delete_button"></button></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <Pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="getData()"/>
            </div>
        </div>
    </div>
</template>

<script>
    import BackModal from '../../Back.vue';
    import ConfirmDeleteTeam from './ConfirmDeleteTeam.vue';
    import Pagination from '../../system/PaginationComponent.vue';
    let axios = require('axios');
    export default {
        name: "Teams",
        data() {
            return {
                has_error: false,
                teams: [],
                selectedItemDelete: null,
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
            this.getData();
        },
        methods: {
            getData() {
                axios.get('teams?page=' + this.pagination.current_page)
                    .then(response => {
                        this.teams = response.data.data.data;
                        this.pagination = response.data.pagination;
                    })
                    .catch(error => {
                        console.log(error.response.data);
                    });
            },
            confirmDelete(item) {
                this.selectedItemDelete = item;
                this.confirmDeleteModal = true;
            },
            cancelDelete() {
                this.selectedItemDelete = null;
                this.confirmDeleteModal = false;
            },
            deleteItem() {
                let tmp_id=this.selectedItemDelete.id;
                axios.delete('team/'+tmp_id)
                    .then(res => {
                        this.getData();
                    })
                    .catch(e => {
                        console.log(e);
                        this.has_error = true;
                    });
                this.selectedItemDelete = null;
                this.confirmDeleteModal = false;
            }
        },
        components: {
            BackModal,
            ConfirmDeleteTeam,
            Pagination
        }
    }
</script>