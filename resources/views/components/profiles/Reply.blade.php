<div class="p-5 border border-b-1 mt-6">
    <div class="flex justify-between items-center">
        <div class="">
            <p>
                <span class="text-2xl font-bold">Replied To </span>
                <a href="{{$path}}" class="text-xl text-blue-600">{{$reply->thread->title}}</a> 
            </p>
        </div>
    </div>
    <p class="m-3"> {{$reply->body}}</p>
</div>