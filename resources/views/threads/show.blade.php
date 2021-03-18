<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight text-center">
        {{$thread->title}}
        </h2>
    </x-slot>

    <div class="p-12 flex">
        <div class="w-2/4 mr-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <article class="m-3">
                            <p>{{$thread->body}}</p>
                        </article>
                            <h2 class="text-3xl ml-2 my-5">Replies</h2>
                        <div class="bg-grey-300 border border-gray-300">
                            @foreach($replies as $reply)
                               <div class="bg-gray-100 p-5">
                                    <p><a href="/threads?by={{$reply->owner->name}}" class="text-blue-600">{{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}</p>
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
                        <article class="m-3">
                            <p>-This Thread Was Published on {{$thread->created_at->diffForHumans()}}</p>
                            <p>-This Thread Was Published By <a href="/threads?by={{$thread->creator->name}}" class="text-blue-600">{{$thread->creator->name}}</a></p>
                            @if($thread->getReplyCount())
                            <p>-This Thread Currently Has {{$thread->getReplyCount()}} {{Str::plural('comment',$thread->getReplyCount())}}</p>
                            @else
                            <p>This Thread has no comment yet! You can participate it!</p>
                            @endif
                        </article>
                </div>
            </div
        </div>
    </div>
</x-app-layout>
