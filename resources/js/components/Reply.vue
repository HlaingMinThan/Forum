<script>
import Axios from "axios";
    export default {
        props:['reply'],
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
