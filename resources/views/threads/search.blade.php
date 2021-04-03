<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Search Threads
        </h2>
    </x-slot>
    <Search  inline-template id="{{config('scout.algolia.id')}}"   search-key="{{config('scout.algolia.key')}}">
        <ais-instant-search :search-client="searchClient" index-name="threads" :initial-ui-state="{ threads: { query: '{{ request('q') }}' } }">
            <div class=" grid  grid-cols-3 gap-4 mt-10 ml-5">
                    <div class="col-span-2">
                        <ais-hits>
                            <div slot="item" slot-scope="{ item }">
                                <a :href="item.path">
                                    <li v-text="item.title"></li>
                                </a>
                            </div>
                        </ais-hits>
                    </div>
                    <div>
                        {{-- search box section --}}
                        <div class=" bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5 p-5 font-semibold">
                            <ais-search-box autofocus />
                        </div>
                        <div class=" bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5 p-5 font-semibold">
                            <h1 class="mb-6">Filter By Channel</h1>
                            <ais-refinement-list attribute="channel.name"  />
                        </div>
                        {{-- trending section --}}
                        @if(count($trending_threads))
                        <x-threads.TrendingThreads :trendingThreads="$trending_threads" />
                        @endif
                    </div>
            </div>
        </ais-instant-search>
    </Search>
</x-app-layout>