<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-4xl text-gray-800 leading-tight text-center">
            {{$user->name}}
        </h1>
            <p class="text-center mt-5">since {{$user->created_at->diffForHumans()}}</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class=" text-2xl ml-5 mb-5 text-gray-800 leading-tight">
                    My Participations
                </h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @forelse($threads as $thread)
                        <article class="p-5">
                            <div class="text-2xl text-blue-600 flex justify-between"> 
                                <div>
                                    <a href="{{$thread->path()}}">{{$thread->title}}</a>
                                </div>
                                <div>
                                    <a href="{{$thread->path()}}" class="text-lg">Replies-{{$thread->replies_count}}</a>
                                </div>
                            </div>
                            <p class="mt-5">{{$thread->body}}</p><hr>
                        </article>
                    @empty

                        <h1>No Threads Post Yet!</h1>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
