<template>
    <div>
        <!-- @error("body")
            <p class="text-base  text-red-400" id="result">{{$message}}</p>
            @enderror-->
        <div v-if="signedIn">
            <div class="my-6">
                <Mentionable :keys="['@']" :items="mapUsernames" offset="6">
                    <Editor
                        v-model="body"
                        api-key="2rg2ynlbqzfn9tenfhz2tu6gnxeg9euzz4o400ubvjgaytm3"
                        plugins="codesample"
                        toolbar="codesample"
                        codesample_global_prismjs="true"
                        :init="{ menubar: false }"
                        placeholder="Come on,You Can Participate in it.."
                    />
                    <!-- wisywyg editor tinymce provided -->
                </Mentionable>
            </div>
            <div class="mb-6">
                <button
                    @click="addReply"
                    type="submit"
                    class="w-full px-3 py-4 text-white bg-blue-500 rounded-md focus:bg-blue-600 focus:outline-none"
                >
                    Add Reply
                </button>
            </div>
        </div>

        <p v-else class="text-center mt-10">
            Pls <a href="/login" class="text-blue-400">sign in</a> to
            participate the discusstion
        </p>
    </div>
</template>

<script>
import Editor from "@tinymce/tinymce-vue";
import axios from "axios";
import { Mentionable } from "vue-mention";
export default {
    components: { Mentionable, Editor },
    data() {
        return {
            usernames: [],
            body: "",
            endpoint: location.pathname + "/replies"
        };
    },
    computed: {
        signedIn() {
            return window.App.signedIn;
        },
        mapUsernames() {
            //map  object key to value for vue-mention
            return this.usernames.map(username => {
                return { value: username.name };
            });
        }
    },
    methods: {
        addReply() {
            if (!this.body) {
                window.flash.error("Please fill the reply body first", "", {
                    timeOut: 1000
                });
                return;
            }
            axios
                .post(this.endpoint, {
                    body: this.body
                })
                .then(res => {
                    let newReply = res.data;
                    this.$emit("store", newReply);
                    this.body = "";
                    window.flash.success("Reply Added", "", { timeOut: 1000 });
                })
                .catch(error => {
                    // catching error from server response
                    window.flash.error(error.response.data, "", {
                        timeOut: 1000
                    });
                    this.body = "";
                });
        }
    },
    created() {
        axios.get("/api/usernames").then(res => {
            this.usernames = res.data;
        });
    }
};
</script>

<style>
.mention-item {
    padding: 5px 5px;
    text-align: center;
    border-radius: 4px;
    border: 1px solid #2e8bc0;
}

.mention-selected {
    background: #2e8bc0;
}
.popper {
    left: 200px !important;
}
</style>
