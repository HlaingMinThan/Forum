<script>
import Replies from "../components/Replies";
import SubscribeButton from "../components/SubscribeButton";
import LockThreadButton from "../components/LockThreadButton";
import axios from 'axios';
export default {
    components:{Replies,SubscribeButton,LockThreadButton},
    props:['thread'],
    data(){
        return{
            replyCount:this.thread.replies_count,
            editor:false,
            title:this.thread.title,
            body:this.thread.body
        }
    },
    methods:{
        destroy(){
            this.replyCount--;
        },
        store(){
            this.replyCount++;
        },
        update(){
            if(!this.title){
                flash.error("please fill in the title input");
            }
            if(!this.body){
                flash.error("please fill in the body input");
            }
            axios.patch(`/threads/${this.thread.channel.name}/${this.thread.slug}`,{
                'title':this.title,
                'body':this.body
            }).then(()=>{
                this.editor=false;
            });
        },
        cancel(){
            this.editor=false;
            //resetting to default data
            this.title=this.thread.title;
            this.body=this.thread.body;
        }
    }
}
</script>