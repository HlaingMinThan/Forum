<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            All Threads 
        </h2>
    </x-slot>

    <div class=" grid  grid-cols-3 gap-4 mt-10 ml-5">
        <div class="col-span-2">
            @forelse($threads as $thread)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mt-1 flex items-center p-1 ml-3">
                            <div class="flex items-center">
                                <img src="{{asset($thread->creator->avator())}}" class="mr-3 rounded-full" width="40" height="40">
                                <a href="{{route('profiles.show',$thread->creator->name)}}" class="font-bold text-blue-500 underline ">
                                    {{$thread->creator->name}}
                                </a>
                            </div>
                            <div class="ml-3">Was Published</div>
                        </div>
                        <article class="p-5">
                            <div class="text-2xl text-blue-600 flex justify-between"> 
                                <div>
                                    @if($thread->hasAnyUpdate())
                                        <a href="{{$thread->path()}}" class="font-bold">
                                            {{$thread->title}}
                                            <span class="text-green-500 text-sm ml-2">Thread Updated</span>
                                        </a>
                                    @else
                                        <a href="{{$thread->path()}}">{{$thread->title}}</a>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{$thread->path()}}" class="text-lg">Replies-{{$thread->replies_count}}</a>
                                </div>
                            </div>
                            <p class="mt-5">{{$thread->body}}</p> 
                            <div class="flex justify-end">
                                <p class="text-lg mt-5  ">visitors- <span class="text-green-500 font-bold">{{$thread->visitors()}}</span></p>
                            </div>
                        </article>
                    </div>
                </div>
            @empty
                <h1>No Threads Found Yet!</h1>
            @endforelse
                {{$threads->links()}}
        </div>
        <div class="">
            @if (count($trending_threads))
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5 p-5 font-semibold">
                    <h1 class=" text-2xl text-center ">Current Trending Threads</h1>
                    <ul class="list-disc list-inside mt-5">
                        @foreach ($trending_threads as $thread)
                        <li class="bg-gray-200 p-3 border border-gray-300 text-lg"><a href="{{$thread->path}}">{{$thread->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
                        
