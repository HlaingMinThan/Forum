<template>
   <div class="ml-3 relative" v-show="notifications.length">
        <div class="mt-2 space-x-4">
              <button @click="showDropdown=!showDropdown" class="bg-gray-800 p-1 rounded-full text-gray-400 mt-2 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                <span class="sr-only">View notifications</span>
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
              </button>
        </div>
        <div v-show="showDropdown" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                <a  v-for="noti in notifications" :key="noti.id" @click="markAsRead(noti.id)" :href="noti.data.link" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-center">{{noti.data.message}}</a>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
  data(){
    return{
      notifications:[],
      showDropdown:false
    }
  },
  methods:{
    markAsRead(notiId){
      axios.delete(`/profiles/${window.App.user.name}/notifications/${notiId}`);
    }
  },
  created(){
    axios.get(`/profiles/${window.App.user.name}/notifications`).then((res)=>{
      this.notifications=res.data;
    })
  }
}
</script>

<style>

</style>