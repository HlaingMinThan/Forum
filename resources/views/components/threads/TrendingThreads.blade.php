@if(count($trendingThreads))
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5 p-5 font-semibold">
    <h1 class=" text-2xl text-center ">Trending Threads <span class="text-blue-500 text-sm ml-2 mb-1"> (People Most Visited This Threads)</span></h1>
    <ul class="list-disc list-inside mt-5">
        @foreach ($trendingThreads as $thread)
        <li class="bg-gray-200 p-3 border border-gray-300 text-lg"><a href="{{$thread->path}}">{{$thread->title}}</a></li>
        @endforeach
    </ul>
</div>
@endif