<template>
    <div
        class=" p-5 border border-b-1"
        :id="`reply_${reply.id}`"
        :class="{ 'bg-blue-100': isBest, 'bg-white': !isBest }"
    >
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div>
                    <a :href="`/profiles/${reply.owner.name}`"
                        ><img
                            :src="avator"
                            class="mr-3 rounded-full"
                            width="40"
                            height="40"
                    /></a>
                </div>
                <div>
                    <a
                        :href="`/profiles/${reply.owner.name}`"
                        class="text-blue-600"
                    >
                        {{ reply.owner.name }}
                    </a>
                    said {{ timesAgo }}
                </div>
            </div>

            <div class="flex justify-between">
                <Favorite :reply="reply"></Favorite>
            </div>
        </div>
        <div>
            <div>
                <div v-if="editor" class="my-5">
                    <Editor
                        v-model="body"
                        api-key="2rg2ynlbqzfn9tenfhz2tu6gnxeg9euzz4o400ubvjgaytm3"
                        plugins="codesample"
                        toolbar="codesample"
                        :init="{ height: 500, menubar: false }"
                        codesample_global_prismjs="true"
                    />
                    <div class="flex">
                        <button
                            @click="update"
                            class="p-2 bg-blue-500 rounded-md text-white flex ml-5"
                        >
                            update
                        </button>
                        <button
                            @click="cancel"
                            class="p-2 bg-gray-100 rounded-md text-gray-900 border border-4 border-gray-700 flex ml-5"
                        >
                            cancel
                        </button>
                    </div>
                </div>
                <div v-if="!editor">
                    <p class="m-3 p-1 text-lg" v-html="body"></p>
                </div>
            </div>
            <!-- authorization -->
            <div class="flex justify-between" v-show="!editor">
                <div v-if="canMarkAsBestReply">
                    <button
                        v-if="!isBest"
                        @click="markAsBestReply"
                        class="p-2 bg-blue-500 rounded-md text-white flex ml-5"
                        type="button"
                    >
                        Mark As Best Reply
                    </button>
                </div>
                <div v-if="canUpdate" class="flex">
                    <button
                        @click="editor = true"
                        class="p-2 bg-blue-500 rounded-md text-white flex ml-5"
                        type="button"
                    >
                        update
                    </button>
                    <button
                        @click="destroy"
                        class="p-2 bg-red-500 rounded-md text-white flex ml-5"
                        type="button"
                    >
                        delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Editor from "@tinymce/tinymce-vue";
import Favorite from "./Favorite.vue";
import axios from "axios";
import moment from "moment";
export default {
    props: ["reply"],
    components: { Favorite, Editor },
    data() {
        return {
            isBest: this.reply.isBest,
            editor: false,
            body: this.reply.body,
            avator: this.reply.owner.avator_path
        };
    },
    methods: {
        update() {
            if (!this.body) {
                window.flash.error("Please fill the reply body first", "", {
                    timeOut: 1000
                });
                return;
            }
            axios
                .patch(`/replies/${this.reply.id}`, {
                    body: this.body
                })
                .then(() => {
                    this.editor = false;
                    window.flash.success("Reply Updated", "", {
                        timeOut: 1000
                    });
                })
                .catch(error => {
                    window.flash.error("Sorry,We don't Allow Spam", "", {
                        timeOut: 1000
                    });
                    this.body = "";
                });
        },
        cancel() {
            this.editor = false;
            //resetting to default data
            this.body = this.reply.body;
        },
        destroy() {
            axios.delete(`/replies/${this.reply.id}`);
            //  $(this.$el).fadeOut(300);//fadeout and remove ui from user'eye with jquery
            this.$emit("destroy", this.reply.id);
        },
        markAsBestReply() {
            axios.post(`/replies/${this.reply.id}/best`);
            window.events.$emit("best_reply_selected", this.reply.id);
        }
    },
    computed: {
        canUpdate() {
            let user = window.App.user;
            if (user) {
                return this.reply.user_id === window.App.user.id; //check that user's reply or not
            } else {
                return false;
            }
        },
        canMarkAsBestReply() {
            let user = window.App.user;
            if (user) {
                return this.reply.thread.creator.id === window.App.user.id; //thread creator can mark best reply
            } else {
                return false;
            }
        },
        timesAgo() {
            return moment(this.reply.created_at).fromNow();
        }
    },
    created() {
        window.events.$on("best_reply_selected", id => {
            this.isBest = this.reply.id === id;
        });
    }
};
</script>
