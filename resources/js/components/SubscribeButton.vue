<template>
    <div class="flex justify-center" v-if="signedIn">
        <button @click="subscribe" class="mt-6     font-bold  py-2 px-4 border border-indigo-500  rounded" :class="dynamicClass">
            {{dynamicText}} This Thread
        </button>
    </div>
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