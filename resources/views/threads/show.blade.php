<x-app-layout>
    <x-slot name="header">
       
    </x-slot>

    <div class="p-12 flex">
        <div class="w-2/4 mr-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <article class="m-3">
                            <h2 class="font-semibold text-3xl text-gray-800 text-center">{{$thread->title}}</h2>
                            <p>{{$thread->body}}</p>
                        </article>
                            <h2 class="text-3xl ml-2 my-5">Replies</h2>
                        <div class="bg-grey-300 border border-gray-300">
                            @foreach($replies as $reply)
                               <div class="bg-gray-100 p-5">
                                    <div class="flex justify-between items-center">
                                        <p><a href="{{route('profiles.show',$thread->creator->name)}}" class="text-blue-600">{{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}</p>
                                        @auth
                                        <div>
                                           <form action='{{route("favorites.store",$reply->id)}}' method="POST">
                                                @csrf
                                                <button class="p-2 bg-gray-200 rounded-md flex" type="submit" {{$reply->favorited()?'disabled':''}}>
                                                    <svg width="24"  height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402m5.726-20.583c-2.203 0-4.446 1.042-5.726 3.238-1.285-2.206-3.522-3.248-5.719-3.248-3.183 0-6.281 2.187-6.281 6.191 0 4.661 5.571 9.429 12 15.809 6.43-6.38 12-11.148 12-15.809 0-4.011-3.095-6.181-6.274-6.181"/></svg>
                                                    <span class="ml-2">{{$reply->favorites_count}}</span>
                                                </button>
                                           </form>
                                        </div>
                                        @endauth
                                    </div>
                                    <p class="m-3"> {{$reply->body}}</p>
                               </div><hr>
                            @endforeach
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
