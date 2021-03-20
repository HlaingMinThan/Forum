<Reply inline-template :reply="{{$reply}}">
    <div class="bg-gray-100 p-5 border border-b-1" id="reply_{{$reply->id}}">
        <div class="flex justify-between items-center">
            <div>
                <p><a href="{{route('profiles.show',$reply->owner->name)}}" class="text-blue-600">{{$reply->owner->name}}</a> said {{$reply->created_at->diffForHumans()}}</p>
            </div>
            @auth
            <div class="flex justify-between">
                <Favorite :reply="{{$reply}}"></Favorite>
            </div>
            @endauth
            @guest
                <a href="/login" class="p-2 bg-gray-200 rounded-md flex" type="submit" disabled>
                        <svg width="24"  height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402m5.726-20.583c-2.203 0-4.446 1.042-5.726 3.238-1.285-2.206-3.522-3.248-5.719-3.248-3.183 0-6.281 2.187-6.281 6.191 0 4.661 5.571 9.429 12 15.809 6.43-6.38 12-11.148 12-15.809 0-4.011-3.095-6.181-6.274-6.181"/></svg>
                        <span class="ml-2">{{$reply->favorites->count()}}</span>
                </a>
            @endguest
        </div>
        <div>
           <div>
                <div v-if="editor" class="my-5">
                    <textarea name="" id="" class="w-full" rows="5" v-model="body"></textarea>
                    <div class="flex">
                        <button @click="update" class="p-2 bg-blue-500 rounded-md text-white flex ml-5">update</button>
                        <button @click="editor=false" class="p-2 bg-gray-100 rounded-md text-gray-900 border border-4 border-gray-700 flex ml-5">cancel</button>
                    </div>
                </div>
                <div v-if="!editor">
                    <p class="m-3" v-text="body"></p>
                </div>
           </div>
            @can('update',$reply)
            <div class="flex justify-end" v-show="!editor">
                     <button  @click="editor=true" class="p-2 bg-blue-500 rounded-md text-white flex ml-5" type="button" >
                        update
                    </button>
                    <button  @click="destroy" class="p-2 bg-red-500 rounded-md text-white flex ml-5" type="button" >
                        delete
                    </button>
            </div>
            @endcan
        </div>
    
    </div>
</Reply>