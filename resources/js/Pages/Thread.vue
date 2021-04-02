<script>
import Replies from "../components/Replies";
import SubscribeButton from "../components/SubscribeButton";
import LockThreadButton from "../components/LockThreadButton";
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
        }
    }
}
</script>