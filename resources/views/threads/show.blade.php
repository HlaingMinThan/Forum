<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight text-center">
        {{$thread->title}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <article class="m-3">
                            <p>{{$thread->body}}</p>
                        </article>
                            <h2 class="text-3xl ml-2 my-5">Replies</h2>
                        <div class="bg-grey-300 border border-gray-300">
                            @foreach($thread->replies as $reply)
                               <div class="bg-gray-100 p-5">
                                    <p><a href="" class="text-blue-600">{{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}</p>
                                    <p class="m-3"> {{$reply->body}}</p>
                               </div><hr>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
