<template>
  <div>
            <!-- @error("body")
            <p class="text-base  text-red-400" id="result">{{$message}}</p>
            @enderror-->
            <div v-if="signedIn">
                <div class="my-6">
                    <textarea required v-model="body" rows="5" name="body" id="message" placeholder="Your Message" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500"></textarea>
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
export default {
    data(){
        return {
            body:"",
            endpoint:location.pathname+"/replies"
        }
    },
    computed:{
        signedIn(){
            return window.App.signedIn;
        }
    },
    methods:{
        addReply(){
            axios.post(this.endpoint,{
                body:this.body
            }).then((res)=>{
                let newReply=res.data;
                this.$emit("store",newReply);
            })
            this.body="";
            // console.log(this.endpoint);
        }
    }
}
</script>

<style>

</style>