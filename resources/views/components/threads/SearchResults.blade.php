<div>
    <ais-state-results>
        <template slot-scope="{ results: { hits, query } }">
            <ais-hits v-if="hits.length">
                <div slot="item" slot-scope="{ item }">
                    <a :href="item.path" class="text-lg cursor-pointer underline text-blue-500">
                        <ais-highlight
                        attribute="title"
                        :hit="item"
                        />
                    </a>
                </div>
            </ais-hits>
            <div v-else >
                No results have been found for <span class="text-blue-600 font-bold">{{request("q")}}</span>
            </div>
        </template>
      </ais-state-results>
</div>
