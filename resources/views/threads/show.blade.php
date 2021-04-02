<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <Thread inline-template :thread="{{$thread}}">
        <div class="p-12 flex">
            <div class="w-2/4 mr-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
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
                                        
                                        @can('update',$thread)
                                            <button @click="editor=true" v-if="!editor" class="px-2 border border-gray-200 font-bold rounded-md  " type="submit" >
                                                ...
                                            </button>
                                        @endcan
                                </div>
                                <div class="mt-5" v-if="!editor">
                                    <h2 class="font-semibold text-3xl text-gray-800" v-text="title"></h2>
                                    <p class="mt-5" v-text="body">{{$thread->body}}</p>
                                </div>
                                <div class="mt-5" v-if="editor">
                                    <input type="text" class="w-full "  v-model="title" >
                                   <textarea name="" id="" class="w-full mt-5" rows="10" v-model="body"></textarea>
                                    <div class="flex justify-between  p-2">
                                        <div class="flex">
                                            <button @click="cancel" class="p-2 bg-gray-200 rounded-md flex" type="submit" >
                                                cancel
                                            </button>
                                            <button @click="update" class="ml-5 p-2 bg-green-500 text-white rounded-md flex" type="submit" >
                                                Update
                                            </button>
                                        </div>
                                        @can('update',$thread)
                                        <form action='{{route("threads.destroy",[$thread->channel->slug,$thread->slug])}}' method="POST">
                                            @method("DELETE")
                                            @csrf
                                            <button class="p-2 bg-red-600 text-white rounded-md flex" type="submit" >
                                                Delete
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                            <Replies @destroy="destroy" @store="store" :lock="{{json_encode($thread->lock)}}"></Replies>
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
                                    <div class="flex justify-between mt-6">
                                        @auth
                                        <div> 
                                                                            {{-- passing true false need to json encode --}}
                                            <Subscribe-button :subscribed="{{json_encode(auth()->user()->subscribed($thread))}}"></Subscribe-button>
                                        </div>
                                        <div>
                                                            {{-- passing true false need to json encode --}}
                                            <Lock-thread-button :lock="{{json_encode($thread->lock)}}"></Lock-thread-button>   
                                        </div>
                                        @endauth
                                    </div>
                                </div>
                                <a href="{{route('threads.index')}}" class="mt-10 w-full px-2 py-2 text-white bg-blue-500 flex justify-center rounded-md focus:bg-blue-600 focus:outline-none">Go Back To Read All Threads</a>
                    </div>
                </div
            </div>
        </div>
    </Thread>
    
</x-app-layout>
