<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Search Threads
        </h2>
    </x-slot>
    <Search  inline-template id="{{config('scout.algolia.id')}}"   search-key="{{config('scout.algolia.key')}}">
        <ais-instant-search 
            :search-client="searchClient" 
            index-name="threads" 
            :initial-ui-state="{ threads: { query: '{{ request('q') }}' } }"
        >
            {{-- 2 column layout --}}
            <div class=" grid  grid-cols-3 gap-4 mt-10 ml-5">
                    <div class="col-span-2">
                        <x-threads.SearchResults></x-threads.SearchResults>
                    </div>
                    <div>
                        {{-- Search Box Widget --}}
                        <x-threads.SearchBox></x-threads.SearchBox>
                        {{-- Filter By Channel Widget --}}
                        <x-threads.FilterByChannel></x-threads.FilterByChannel>
                        {{-- Trending Thread Widget --}}
                        <x-threads.TrendingThreads/>
                    </div>
            </div>
        </ais-instant-search>
    </Search>
</x-app-layout>