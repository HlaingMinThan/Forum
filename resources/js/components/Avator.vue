<template>
        <div>
          <div class="flex justify-center mb-5">
              <img :src="avator" class="rounded-full" width="200" height="200">
          </div>
              <!-- @can("update",$profileUser) -->
          <div  v-if="canUpdate" class="flex justify-between items-center my-5 border border-color-dark p-1">
            <form action="" method="POST" enctype="multipart/form-data">
                    <input type="file" name="avator" accept="image/*" @change="selectPhoto" class="bg-gray-200 text-dark p-2">
            </form>
          </div>
        </div>
                    <!-- @error('avator')
                        <p class="text-center text-red-500 font-bold">{{ $message }}</p>
                    @enderror -->
                <!-- @endcan -->
</template>

<script>
import axios from 'axios';
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
  },
  methods:{
    selectPhoto(e){
      //avator file
      let avator=e.target.files[0];

      //get select avator location
      let reader=new FileReader();
      reader.readAsDataURL(avator);
      reader.onload=e=>{
        let src=e.target.result;
        // change avator in user ui view
        this.avator=src;
      }
      
      // making like a form sending avator file
      let data=new FormData;//creating a form
      data.append('avator',avator);//creating  input name with "avator" and file with avator file

      // send request in backend
      axios.post(`/profiles/${this.user.name}/avator`,data);

      window.flash.success("your profile has been updated :)");
    }
  }
}
</script>

<style>

</style>