<template>
    <button class=" font-bold  py-2 px-4 border border-red-500  rounded" :class="{'bg-red-500 text-white':isLocked,'bg-transparent text-red-700':!isLocked}" @click="toggleLock">{{dynamicText}} This Thread</button>
</template>

<script>
import axios from 'axios';
export default {
    props:['lock'],
    data(){
        return {
            isLocked:this.lock
        }
    },
    methods:{
        toggleLock(){
            if(this.isLocked){
               this.unLockThread();
            }else{
                this.lockThread();
            }
        },
        lockThread(){
             this.isLocked=true;
            axios.post(`${window.location.pathname}/lock`);
            window.events.$emit("lockThread");
        },
        unLockThread(){
            this.isLocked=false;
            axios.delete(`${window.location.pathname}/lock`);
            window.events.$emit("unLockThread");
        }
    },
    computed:{
        dynamicText(){
            return this.isLocked ? "unlock" : 'lock';
        }
    }
}
</script>

<style>

</style>