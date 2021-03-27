<template>
        <div>
          <div class="flex justify-center mb-5">
              <img :src="avator" class="rounded-full" width="200" height="200">
          </div>
              <!-- @can("update",$profileUser) -->
          <div  v-if="canUpdate" class="flex justify-between items-center my-5 border border-color-dark p-1">
            <form action="" method="POST" enctype="multipart/form-data">
                    <input type="file" name="avator" accept="image/*" id="">
                    <button class="bg-blue-600 text-white p-2 rounded-md" type="submit">Add Profile</button>
            </form>
          </div>
        </div>
                    <!-- @error('avator')
                        <p class="text-center text-red-500 font-bold">{{ $message }}</p>
                    @enderror -->
                <!-- @endcan -->
</template>

<script>
export default {
  props:['user'],
  data(){
    return {
      avator:this.user.avator_path
    }
  },
  computed:{
    canUpdate(){
        let user=window.App.user;
        if(user){
            return this.user.id===user.id;//check that user's reply or not
        }else{
            return false
        }
    }
  }
}
</script>

<style>

</style>