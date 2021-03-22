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
        <New-Reply @store="store"></New-Reply>
    </div>
</template>
<script>
import Reply from "./Reply.vue";
import NewReply from "./NewReply.vue";
export default {
    props:['replies'],
    components:{Reply,NewReply},
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
        },
        store(newReply){
            this.allReplies.push(newReply);
            this.$emit("store");
        }
    }
}
</script>

<style>

</style>