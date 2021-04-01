<template>
   
        <button @click="subscribe" class=" font-bold  py-2 px-4 border border-indigo-500  rounded" v-if="signedIn" :class="dynamicClass">
            {{dynamicText}} This Thread
        </button>

</template>

<script>
import axios from 'axios'
export default {
    props:['subscribed'],
    data(){
        return{
            isSubscribed:this.subscribed,
        }
    },
    computed:{
        dynamicClass(){
            return this.isSubscribed ?  'bg-indigo-500 text-white' : "bg-transparent text-indigo-700 " 
        },
        dynamicText(){
            return this.isSubscribed ?  'UnSubscribe' : 'Subscrbe'

        },
        signedIn(){
            return window.App.signedIn;
        }
    },
    methods:{
        subscribe(){
            if(this.isSubscribed)
            {
                this.unsubscribe();
            }else{
                axios.post(location.pathname+"/subscriptions");
                this.isSubscribed=true;
            }
        },
        unsubscribe(){
            axios.delete(location.pathname+"/subscriptions");
            this.isSubscribed=false;
        }
    }
}
</script>

<style>

</style>