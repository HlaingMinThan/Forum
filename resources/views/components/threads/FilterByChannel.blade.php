<ais-state-results>
    <template slot-scope="{ results: { hits, query } }">
        <div v-if="hits.length" class=" bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5 p-5 font-semibold">
            <h1 class="mb-6">Filter By Channel</h1>
            <ais-refinement-list attribute="channel.name"  />
        </div>
        <div v-else>
        </div>
    </template>
</ais-state-results>
    