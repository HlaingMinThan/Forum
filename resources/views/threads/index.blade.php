<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            All Threads
        </h2>
    </x-slot>

    <div class=" grid  grid-cols-3 gap-4 mt-10 ml-5">
        <div class="col-span-2">
            @forelse($threads as $thread)
            <x-threads.Thread :thread="$thread" />
            @empty
            <h1>No Threads Found Yet!</h1>
            @endforelse
            {{ $threads->links() }}
        </div>
        <div>
            {{-- search box section --}}
            <div class=" bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5 p-5 font-semibold">
                <form action="/threads/search" class="flex">
                    <input name="q" type="search" placeholder="search anything u want..."
                        class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"
                        id="">
                        <button class="p-2 bg-gray-200 rounded-md">submit</button>
                </form>
            </div>

            {{-- trending section --}}
            <x-threads.TrendingThreads/>
        </div>
    </div>
</x-app-layout>