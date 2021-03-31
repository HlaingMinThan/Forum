<script>
import Replies from "../components/Replies";
import SubscribeButton from "../components/SubscribeButton";
export default {
    components:{Replies,SubscribeButton},
    props:['thread'],
    data(){
        return{
            replyCount:this.thread.replies_count
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