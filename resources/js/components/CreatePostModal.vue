<template>
    <!-- Modal -->
    <div class="modal fade" id="create_post_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">创建帖子</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="editor">
                        <input v-model="postTitle" type="text" class="form-control">
                        <br/>
                        <textarea v-model="input"></textarea>
                        <div v-html="compiledMarkdown"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_create_post_modal">取消</button>
                    <button type="button" class="btn btn-primary" @click="createPost">发布</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import marked from 'marked';
import DOMPurify from 'dompurify';


export default {
    name: "CreatePost",
    data() {
        return {
            input: "# 默认内容",
            postTitle: "默认标题"
        }
    },
    computed: {
        compiledMarkdown: function() {

            let clean_md = DOMPurify.sanitize(this.input); // cleaned data to prevent xss
            return marked(clean_md);
        }
    },
    methods:{
        createPost(){

            let clean_md = DOMPurify.sanitize(this.input);

            axios.post('/api/post/create',{
                postTitle:this.postTitle,
                postContent:clean_md
            })
            .then((res) => {
                console.log(res.data);
                this.$emit("post-created");
                $("#close_create_post_modal").click();
            })
            .catch((err) => {
                console.log(err);
            })
            .finally(() => {
                this.postTitle = "默认标题";
                this.input = "# 默认内容";
            })
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
