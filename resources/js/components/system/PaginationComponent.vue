<template>
    <div class="row pagination" role="navigation" aria-label="pagination">
        <div class="col-md-auto">
            <a class="btn btn-outline-primary" style="margin-right:5px; float:left" @click.prevent="changePage(1)" :disabled="pagination.current_page <= 1">Pirmas</a>
            <a class="btn btn-outline-primary" style="margin-right:5px; float:left" @click.prevent="changePage(pagination.current_page - 1)" :disabled="pagination.current_page <= 1">Praėjęs</a>
        </div>
        <div class="col-md-3 mx-auto">
            <div v-for="page in pages">
                <a class="btn btn-outline-primary" style="margin-left:2px; float:left" :class="isCurrentPage(page) ? 'btn-success' : ''" @click.prevent="changePage(page)">{{ page }}</a>
            </div>
        </div>
        <div class="col-md-auto">
            <a class="btn btn-outline-primary" style="margin-right:5px; float:left" @click.prevent="changePage(pagination.current_page + 1)" :disabled="pagination.current_page >= pagination.last_page">Kitas</a>
            <a class="btn btn-outline-primary" style="float:left" @click.prevent="changePage(pagination.last_page)" :disabled="pagination.current_page >= pagination.last_page">Paskutinis</a>
        </div>
    </div>
</template>

<style>
    .pagination {
        margin-top: 5px;
    }
</style>

<script>
    export default {
        props: ['pagination', 'offset'],
        methods: {
            isCurrentPage(page) {
                return this.pagination.current_page === page;
            },
            changePage(page) {
                if (page > this.pagination.last_page) {
                    page = this.pagination.last_page;
                }
                this.pagination.current_page = page;
                this.$emit('paginate');
            }
        },
        computed: {
            pages() {
                let pages = [];
                let from = this.pagination.current_page - Math.floor(this.offset / 2);
                if (from < 1) {
                    from = 1;
                }
                let to = from + this.offset - 1;
                if (to > this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                while (from <= to) {
                    pages.push(from);
                    from++;
                }
                return pages;
            }
        }
    }
</script>