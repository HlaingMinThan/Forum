<script>
import Favorite from "./Favorite.vue";
import Axios from "axios";
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
                 $(this.$el).fadeOut(300);//fadeout and remove ui from user'eye with jquery
                console.log("deleted");
            }
       }
    }
</script>
