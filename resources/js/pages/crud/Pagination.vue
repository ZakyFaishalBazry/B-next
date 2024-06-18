<template>
    <ul class="pagination">
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
            <a class="page-link" href="#" @click.prevent="changePage(1)">First</a>
        </li>
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
            <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)">Previous</a>
        </li>

        <li class="page-item" v-for="page in pages" :key="page"
            :class="{ active: currentPage === page, disabled: page === '...' }">
            <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
        </li>

        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
            <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)">Next</a>
        </li>
        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
            <a class="page-link" href="#" @click.prevent="changePage(totalPages)">Last</a>
        </li>
    </ul>
</template>

<script>
export default {
    props: {
        totalPages: {
            type: Number,
            required: true,
        },
        currentPage: {
            type: Number,
            required: true,
        }
    },
    computed: {
        pages() {
            const pages = [];
            const range = 2; // Number of pages to show before and after the current page
            const startPage = Math.max(1, this.currentPage - range);
            const endPage = Math.min(this.totalPages, this.currentPage + range);

            if (startPage > 1) {
                pages.push(1);
                if (startPage > 2) {
                    pages.push('...');
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                pages.push(i);
            }

            if (endPage < this.totalPages) {
                if (endPage < this.totalPages - 1) {
                    pages.push('...');
                }
                pages.push(this.totalPages);
            }

            return pages;
        }
    },
    methods: {
        changePage(page) {
            if (page !== '...' && page !== this.currentPage) {
                this.$emit('page-changed', page);
            }
        }
    }
};
</script>

<style>
.pagination {
    display: flex;
    list-style: none;
    padding-left: 0;
}

.page-item {
    margin: 0 5px;
}

.page-item.disabled .page-link {
    pointer-events: none;
    opacity: 0.6;
}

.page-item.active .page-link {
    font-weight: bold;
    background-color: #007bff;
    color: white;
}

.page-link {
    cursor: pointer;
    text-decoration: none;
    padding: 0.5em 1em;
    color: #007bff;
}
</style>
