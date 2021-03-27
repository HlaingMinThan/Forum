<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <div>
                <div class="flex justify-center mb-5">
                    <img src="{{asset($user->avator())}}" width="200" height="200">
                </div>
                <div class="flex justify-between items-center my-5 border border-color-dark p-1">
                   <form action="{{route('avator.update',$user->name)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="avator" id="">
                        <button class="bg-blue-600 text-white p-2 rounded-md" type="submit">Add Profile</button>
                   </form>
                </div>
                <h1 class="font-semibold text-4xl mt-3 text-gray-800 leading-tight text-center">
                    {{$user->name}}
                </h1>
                <p class="text-center mt-5">since {{$user->created_at->diffForHumans()}}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class=" text-2xl ml-5 mb-5 text-gray-800 leading-tight">
                    My Participations
                </h1>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @forelse($activities as $date=>$activitiesByDate)
                        <h1 class="text-2xl my-6 ml-4 text-blue-400 font-semibold text-right">On {{$date}}</h1>
                        @foreach($activitiesByDate as $activity)
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
                                    :replyBody="$activity->subject->favorited->body"
                                    :path="$activity->subject->favorited->path()"
                                />
                            @endif
                        @endforeach
                    @empty
                        <h1>This user has not activity yet!</h1>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
