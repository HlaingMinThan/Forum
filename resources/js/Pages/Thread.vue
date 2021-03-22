<script>
import Replies from "../components/Replies";
export default {
    components:{Replies},
    props:['thread'],
    data(){
        return{
            replyCount:this.thread.replies.length
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