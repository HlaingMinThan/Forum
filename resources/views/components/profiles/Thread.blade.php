<article class="p-5 border mt-5">
    <div class=" flex justify-between"> 
        <div>
        <span class="text-2xl font-bold">Started a new Conversation </span>

            <a href="{{$path}}" class="text-blue-600 text-xl">{{$title}}</a> 
        </div>
        <div>
            <a href="{{$path}}" class="text-lg">Replies-{{$replyCount}}</a>
        </div>
    </div>
    <p class="mt-5">{{$body}}</p>
</article>
