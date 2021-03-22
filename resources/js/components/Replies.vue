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
            <Pagination :paginationDatas="paginationDatas" @pageChanged="fetchDatas"></Pagination>
        </div>
        <New-Reply @store="store"></New-Reply>
    </div>
</template>
<script>
import Reply from "./Reply.vue";
import NewReply from "./NewReply.vue";
import axios from 'axios';
export default {
    components:{Reply,NewReply},
    data(){
        return{
            allReplies:[],
            paginationDatas:[],
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
        },
        //this method run initial first time and every time a user click pagination link
        fetchDatas(pageNum){
            // pageNum is empty on initial fetch
            //pageNum get From pageChanged event from pagination component
            if(!pageNum){
                // check user search From url with page query
                let query=location.search.match(/page=(\d+)/);
                pageNum=query? query[1]:1;
            }
             axios.get(`${location.pathname}/replies?page=${pageNum}`)
            .then((res)=>{
                this.allReplies=res.data.data;
                this.paginationDatas=res.data;
            })
        }
    },
    created(){
       this.fetchDatas(); //initial fetching replies and pagination datas
    }
}
</script>

<style>

</style>