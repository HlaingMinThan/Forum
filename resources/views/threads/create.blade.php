<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            All Threads
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('threads.store')}}" method="POST" id="form" class="mt-3">
                            @csrf
                            @error("title")
                            <p class="text-base  text-red-400" id="result">{{$message}}</p>
                            @enderror
                            <div class="mb-6">
                                <input name="title" placeholder="Your Thread Title" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" ></input>
                            </div>
                            @error("body")
                            <p class="text-base  text-red-400" id="result">{{$message}}</p>
                            @enderror
                            <div class="mb-6">
                                <textarea rows="5" name="body" id="message" placeholder="Your body" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" ></textarea>
                            </div>
                           
                            <div class="mb-6">
                                <button type="submit" class="w-full px-3 py-4 text-white bg-blue-500 rounded-md focus:bg-blue-600 focus:outline-none">Add Thread</button>
                            </div>
                            <p class="text-base text-center text-gray-400" id="result">
                            </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
