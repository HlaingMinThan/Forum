<template>
  <div>
            <!-- @error("body")
            <p class="text-base  text-red-400" id="result">{{$message}}</p>
            @enderror-->
            <div v-if="signedIn">
                <div class="my-6">
                    <Mentionable
                        :keys="['@']"
                        :items="mapUsernames"
                        offset="6"
                    >
                        <textarea  required v-model="body" rows="5" name="body" id="message" placeholder="Your Can Participate" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"/>
                    </Mentionable>
                </div>
                <div class="mb-6">
                    <button @click="addReply" type="submit" class="w-full px-3 py-4 text-white bg-blue-500 rounded-md focus:bg-blue-600 focus:outline-none">Add Reply</button>
                </div>
            </div>
                                
            <p v-else    class="text-center mt-10">Pls <a href="/login" class="text-blue-400">sign in</a> to participate the discusstion</p>
  </div>
</template>

<script>
import axios from 'axios';
import { Mentionable } from 'vue-mention'
export default {

    components: {Mentionable},
    data(){
        return {
            usernames:[],
            body:"",
            endpoint:location.pathname+"/replies"
        }
    },
    computed:{
        signedIn(){
            return window.App.signedIn;
        },
        mapUsernames(){
            //map  object key to value for vue-mention
           return this.usernames.map(username=>{
                return {value:username.name};
            })
        }
    },
    methods:{
        addReply(){
            if(!this.body){
                window.flash.error("Please fill the reply body first",'',{timeOut:1000});
                return;
            }
            axios.post(this.endpoint,{
                body:this.body
            }).then((res)=>{
                let newReply=res.data;
                this.$emit("store",newReply);
                this.body="";
                window.flash.success('Reply Added','',{timeOut:1000});
            }).catch((error)=>{
                // catching error from server response
                window.flash.error(error.response.data,'',{timeOut:1000});
                this.body="";
            })
        }
    },
    created(){
        axios.get("/api/usernames").then((res)=>{
            this.usernames=res.data;
        });
    }
}
</script>

<style>
.mention-item {
    padding: 5px 5px;;
  text-align: center;
  border-radius: 4px;
  border:1px solid #2E8BC0;
}

.mention-selected {
  background: #2E8BC0
}
.popper{
    left:200px  !important;
}
</style>