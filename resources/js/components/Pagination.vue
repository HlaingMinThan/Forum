<template>
    <div
        v-show="shouldPaginate"
        class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6"
    >
        <div
            class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
        >
            <div>
                <nav
                    class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                    aria-label="Pagination"
                >
                    <a
                        v-show="prev"
                        @click.prevent="page--"
                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                    >
                        <span>Prev</span>
                        <svg
                            class="h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </a>
                    <a
                        v-for="i in totalPages"
                        :key="i"
                        @click.prevent="page = i"
                        :class="{ 'bg-blue-400 text-white': page == i }"
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 cursor-pointer	"
                    >
                        {{ i }}
                    </a>

                    <a
                        v-show="next"
                        @click.prevent="page++"
                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50"
                    >
                        <span>Next</span>
                        <!-- Heroicon name: solid/chevron-right -->
                        <svg
                            class="h-5 w-5"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </a>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["paginationDatas"],
    data() {
        return {
            page: 1,
            next: false,
            prev: false,
            totalPages: null
        };
    },
    watch: {
        paginationDatas() {
            this.page = this.paginationDatas.current_page;
            this.totalPages = this.paginationDatas.last_page;
            this.next = this.paginationDatas.next_page_url;
            this.prev = this.paginationDatas.prev_page_url;
        },
        page() {
            this.$emit("pageChanged", this.page);
            history.pushState(null, null, `?page=${this.page}`); //only change  page number query on url for user vision
        }
    },
    computed: {
        shouldPaginate() {
            return !!this.next || !!this.prev;
        }
        // currentPage(){
        //     return page=i;
        // }
    }
};
</script>

<style></style>
