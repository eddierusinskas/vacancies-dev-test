<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item" v-if="current !== 1">
                <a class="page-link" href="#" @click.prevent="setPage(current - 1)">Previous</a>
            </li>
            <li class="page-item"
                :class="current === p ? 'active' : ''"
                v-for="p in total">
                <a class="page-link" href="#" @click.prevent="setPage(p)">{{ p }}</a>
            </li>
            <li class="page-item" v-if="current !== total">
                <a class="page-link" href="#" @click.prevent="setPage(current + 1)">Next</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "Pagination",
    props: {
        total: Number,
        current: Number
    },
    methods: {
        setPage(page) {
            this.$emit('page', page);
        }
    },

}
</script>
