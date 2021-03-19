<x-app-layout>
    <x-slot name="header">
       
    </x-slot>

    <div class="p-12 flex">
        <div class="w-2/4 mr-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <article class="m-3">
                           <div class="flex justify-between">
                                <h2 class="font-semibold text-3xl text-gray-800 text-center">{{$thread->title}}</h2>
                                <form action='{{route("threads.destroy",[$thread->channel->slug,$thread->id])}}' method="POST">
                                    @method("DELETE")
                                    @csrf
                                    <button class="p-2 bg-gray-200 rounded-md flex ml-5" type="submit" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M3 6v18h18v-18h-18zm5 14c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4-18v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712z"/></svg>
                                    </button>
                                </form>
                           </div>
                            <p class="mt-5">{{$thread->body}}</p>
                        </article>
                            <h2 class="text-2xl ml-2 my-5">Replies</h2>
                        <div class="bg-grey-300  border-gray-300">
                            @forelse($replies as $reply)
                              <x-app.RepliesBox :reply=$reply />
                            @empty
                            <h1 class="ml-2">No Replies Yet !!!</h1>
                            @endforelse
                            {{$replies->links()}}
                        </div>
                       @auth
                       <form action="{{route('replies.store',$thread->id)}}" method="POST" id="form" class="mt-3">
                            @csrf

                            @error("body")
                            <p class="text-base  text-red-400" id="result">{{$message}}</p>
                            @enderror
                            <div class="mb-6">
                                <textarea rows="5" name="body" id="message" placeholder="Your Message" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"></textarea>
                            </div>
                            <div class="mb-6">
                                <button type="submit" class="w-full px-3 py-4 text-white bg-blue-500 rounded-md focus:bg-blue-600 focus:outline-none">Add Reply</button>
                            </div>
                            
                        </form>
                       @endauth
                       @guest
                        <p class="text-center mt-10">Pls <a href="{{route('login')}}" class="text-blue-400">sign in</a> to participate the discusstion</p>
                       @endguest
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
                            @if($replyCount=$thread->replies->count())
                            <p class="mt-2">-This Thread Currently Has {{$replyCount}} {{Str::plural('comment',$replyCount)}}</p>
                            @else
                            <p class="mt-2">This Thread has no comment yet! Anyone can participate it!</p>
                            @endif
                        </div>
                            <a href="{{route('threads.index')}}" class="mt-10 w-full px-2 py-2 text-white bg-blue-500 flex justify-center rounded-md focus:bg-blue-600 focus:outline-none">Go Back To Read All Threads</a>
                </div>
            </div
        </div>
    </div>
</x-app-layout>
