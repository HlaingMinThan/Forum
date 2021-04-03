@if(count($trendingThreads))
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5 p-5 font-semibold">
    <h1 class=" text-2xl text-center ">Current Trending Threads</h1>
    <ul class="list-disc list-inside mt-5">
        @foreach ($trendingThreads as $thread)
        <li class="bg-gray-200 p-3 border border-gray-300 text-lg"><a href="{{$thread->path}}">{{$thread->title}}</a></li>
        @endforeach
    </ul>
</div>
@endif