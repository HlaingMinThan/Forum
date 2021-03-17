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
                    @foreach($threads as $thread)
                        <article class="p-5">
                            <h1 class="text-2xl text-green-00"><a href="" class="text-2xl text-blue-400">{{$thread->creator->name}}</a> posted <a href="{{$thread->path()}}">{{$thread->title}}</a></h1>
                            <p>{{$thread->body}}</p><hr>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
