<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-4xl text-gray-800 leading-tight text-center">
            {{$user->name}}
        </h1>
            <p class="text-center mt-5">since {{$user->created_at->diffForHumans()}}</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class=" text-2xl ml-5 mb-5 text-gray-800 leading-tight">
                    My Participations
                </h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($activities as $date=>$activitiesByDate)
                        <h1 class="text-2xl my-6 ml-4 text-blue-400 font-semibold text-right">On {{$date}}</h1>
                        @forelse($activitiesByDate as $activity)
                            @if($activity->type==="created_thread")
                                <x-profiles.Thread 
                                    :title="$activity->subject->title"
                                    :body="$activity->subject->body" 
                                    :replyCount="$activity->subject->replies->count()" 
                                    :path="$activity->subject->path()"
                                    :creator="$activity->subject->creator->name"
                                />
                            @endif
                            @if($activity->type==="created_reply")
                                <x-profiles.Reply
                                    :reply="$activity->subject"
                                    :path="$activity->subject->path()"
                                />
                            @endif
                            @if($activity->type==="created_favorite")
                                <x-profiles.Favorite
                                    :title="$activity->subject->favorited->body"
                                    :path="$activity->subject->favorited->path()"
                                />
                            @endif
                        @empty
                            <h1>No Threads Post Yet!</h1>
                        @endforelse
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
