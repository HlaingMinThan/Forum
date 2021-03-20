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
            }
       }
    }
</script>
