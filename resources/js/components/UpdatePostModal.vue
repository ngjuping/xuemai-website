<template>
    <!-- Modal -->
    <div class="modal fade" id="update_post_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">修改帖子</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="editor">
                        <input v-model="postNewTitle" type="text" class="form-control">
                        <br/>
                        <textarea v-model="postNewContent"></textarea>
                        <div v-html="compiledMarkdown"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_update_post_modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="updatePost">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import DOMPurify from "dompurify";
import marked from "marked";

export default {
    name: "updatePostModal",
    props:["post"],
    data(){
        return {
            postNewTitle:"",
            postNewContent:""
        }
    },
    computed: {
        compiledMarkdown: function() {

            let clean_md = DOMPurify.sanitize(this.postNewContent); // cleaned data to prevent xss
            return marked(clean_md);
        }
    },
    methods:{
        updatePost(){
            let clean_content_md = DOMPurify.sanitize(this.postNewContent);

            axios.put(`/api/post/${this.post.id}`,{
                postTitle:this.postNewTitle,
                postContent:clean_content_md
            })
                .then((res) => {
                    console.log(res.data);
                    this.$emit("post-updated");
                    $("#close_update_post_modal").click();
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(() => {
                    this.postNewTitle = "";
                    this.postNewContent = "";
                })
        }
    },
    watch:{
        post(newpost){
            this.postNewTitle = newpost.postTitle;
            this.postNewContent = newpost.postContent;
        }
    }
}
</script>

<style scoped>
    #editor {
        margin: 0;
        height: 100%;
        font-family: "Helvetica Neue", Arial, sans-serif;
        color: #333;
    }

    textarea,
    #editor div {
        display: inline-block;
        width: 49%;
        height: 100%;
        vertical-align: top;
        box-sizing: border-box;
        padding: 0 20px;
        min-height: 400px;
    }

    textarea {
        border: none;
        border-right: 1px solid #ccc;
        resize: none;
        outline: none;
        background-color: #f6f6f6;
        font-size: 14px;
        font-family: "Monaco", courier, monospace;
        padding: 20px;
    }

    code {
        color: #ff6666;
    }
</style>
