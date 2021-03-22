<template>
     <div class="bg-gray-100 p-5 border border-b-1" :id="`reply_${reply.id}`">
        <div class="flex justify-between items-center">
            <div>
                <p><a :href="`/profiles/${reply.owner.name}`" class="text-blue-600">{{reply.owner.name}}</a> said {{timesAgo}} </p>
            </div>
          
            <div class="flex justify-between">
                <Favorite :reply="reply"></Favorite>
            </div>
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
            <!-- @can('update',$reply) -->
            <div class="flex justify-end" v-show="!editor" v-if="canUpdate">
                     <button  @click="editor=true" class="p-2 bg-blue-500 rounded-md text-white flex ml-5" type="button" >
                        update
                    </button>
                    <button  @click="destroy" class="p-2 bg-red-500 rounded-md text-white flex ml-5" type="button" >
                        delete
                    </button>
            </div>
            <!-- @endcan -->
        </div>
    
    </div>
</template>
<script>
import Favorite from "./Favorite.vue";
import axios from 'axios';
import moment from 'moment';
    export default {
        props:['reply'],
        components:{Favorite},
        data() {
            return{
                editor:false,
                body:this.reply.body
            }
        },
       methods:{
            update(){
                axios.patch(`/replies/${this.reply.id}`,{
                    body:this.body
                });
                this.editor=false;
            },
            destroy(){
                 axios.delete(`/replies/${this.reply.id}`);
                //  $(this.$el).fadeOut(300);//fadeout and remove ui from user'eye with jquery
                this.$emit("destroy",this.reply.id);
            }
       },
       computed:{
           canUpdate(){
               let user=window.App.user;
               if(user){
                   return this.reply.user_id===window.App.user.id;//check that user's reply or not
               }else{
                   return false
               }
           },
           timesAgo(){
               return moment(this.reply.created_at).fromNow();
           }
       }
    }
</script>
