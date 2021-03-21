<template>
    <div>
        <h2 class="text-2xl ml-2 my-5">Replies</h2>
                            <div class="bg-grey-300  border-gray-300">
                                <div v-if="allReplies.length">
                                    <div  v-for="reply in allReplies" :key="reply.id" >
                                        <Reply :reply="reply"  @destroy="destroy"></Reply>
                                    </div>
                                </div>
                                <div v-else>
                                    <h1 class="ml-2">No Replies Yet !!!</h1>
                                </div>
                                <!-- {{$replies->links()}} //pagination-->

                            </div>

                        <!-- @auth
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
                        @endguest -->
    </div>
</template>
<script>
import Reply from "./Reply.vue";
export default {
    props:['replies'],
    components:{Reply},
    data(){
        return{
            allReplies:this.replies
        }
    },
    methods:{
        destroy(replyId){
            this.$emit("destroy");
            this.allReplies=this.allReplies.filter(reply=>{
                return reply.id!=replyId;
            });
        }
    }
}
</script>

<style>

</style>