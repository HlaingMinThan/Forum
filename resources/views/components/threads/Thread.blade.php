<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="mt-1 flex justify-between items-center p-1 ml-3">
            <div class="flex  items-center">
                <a href="{{route('profiles.show',$thread->creator->name)}}">
                    <img src="{{asset($thread->creator->avator())}}" class="mr-3 rounded-full" width="40" height="40">
                    <a href="{{route('profiles.show',$thread->creator->name)}}" class="font-bold  ">
                        {{$thread->creator->name}} 
                    </a>
                </a>
                <span class="ml-5 text-sm text-gray-500">
                    {{$thread->created_at->diffForHumans()}}
                </span>
            </div>
            <div class="bg-green-500 text-white p-2 rounded-lg shadow-lg">
                <a href="{{$thread->channel->path()}}">{{strtoupper($thread->channel->name)}}</a>
            </div>
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
                
            </div>
            <p class="mt-3">{{substr(strip_tags($thread->body),0,300)}}...</p> 
            <div class="flex justify-end mt-5">
                <div class="mr-5">
                    <a href="{{$thread->path()}}" class="text-lg">Replies-<span class="text-green-500 font-bold">{{$thread->replies_count}}</span></a>
                </div>|
                <p class="text-lg ml-5">visitors- <span class="text-green-500 font-bold">{{$thread->visitors()}}</span></p>
            </div>
        </article>
    </div>
</div>