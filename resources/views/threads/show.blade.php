<x-app-layout>
    <x-slot name="header">
       
    </x-slot>
    <Thread inline-template :thread="{{$thread}}">
        <div class="p-12 flex">
            <div class="w-2/4 mr-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                            <article class="m-3">
                                <div class="flex justify-between">
                                        <div class="flex items-center">
                                            <div>
                                                <img src="{{asset($thread->creator->avator())}}" class="mr-3 rounded-full" width="40" height="40">
                                            </div>
                                            <div>
                                                <a href="{{route('profiles.show',$thread->creator->name)}}" class="font-bold text-blue-500 underline ">
                                                    {{$thread->creator->name}}
                                                </a>
                                            </div>
                                        </div>
                                        <h2 class="font-semibold text-3xl text-gray-800 text-center">{{$thread->title}}</h2>
                                        @can('update',$thread)
                                        <form action='{{route("threads.destroy",[$thread->channel->slug,$thread->id])}}' method="POST">
                                            @method("DELETE")
                                            @csrf
                                            <button class="p-2 bg-gray-200 rounded-md flex ml-5" type="submit" >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M3 6v18h18v-18h-18zm5 14c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4-18v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712z"/></svg>
                                            </button>
                                        </form>
                                        @endcan
                                </div>
                                <p class="mt-5">{{$thread->body}}</p>
                            </article>
                            <Replies @destroy="destroy" @store="store"></Replies>
                    </div>
                </div>
            </div>
            <div class="w-2/4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1 class="text-center text-lg">About This Thread</h1>
                            <div class="m-3">
                                <p class="mt-2">-This Thread Was Published on {{$thread->created_at->diffForHumans()}}</p>
                                <p class="mt-2">-This Thread Was Published By <a href="{{route('profiles.show',$thread->creator->name)}}" class="text-blue-600">{{$thread->creator->name}}</a></p>

                                    <p class="mt-2" v-if="replyCount">-This Thread Currently Has 
                                        <span v-text="replyCount"></span>  comments
                                        <!-- for dynamic update -->
                                    </p>

                                    <p v-else class="mt-2">This Thread has no comment yet! Anyone can participate it!</p>
                                    <Subscribe-button :subscribed="{{json_encode(auth()->user()->subscribed($thread))}}"></Subscribe-button>
                            </div>
                                <a href="{{route('threads.index')}}" class="mt-10 w-full px-2 py-2 text-white bg-blue-500 flex justify-center rounded-md focus:bg-blue-600 focus:outline-none">Go Back To Read All Threads</a>
                    </div>
                </div
            </div>
        </div>
    </Thread>
    
</x-app-layout>
