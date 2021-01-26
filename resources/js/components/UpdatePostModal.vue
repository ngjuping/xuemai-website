<template>
    <!-- Modal -->
    <div class="modal fade" id="update_post_modal">
        <div class="modal-dialog modal-xl" role="document">
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
                        <h3>内容</h3>
                        <markdown-editor class="p-0" v-model="postNewContent" toolbar="bold italic strikethrough heading numlist bullist code quote uploadimage newlink redo undo"
                                         @command:uploadimage="uploadimage"
                                         @command:newlink="newlink"
                                         :extend="custom" autofocus></markdown-editor>
                        <div v-html="compiledMarkdown" id="preview"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_update_post_modal">取消</button>
                    <button type="button" class="btn btn-primary" @click="updatePost">发布</button>
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
            postNewContent:"",
            custom: {
                // Names should be all small letter
                'uploadimage': {
                    cmd: 'uploadimage',
                    ico: 'fas far fa-image mdi mdi-image',
                    title: 'Upload Image'
                },
                'newlink': {
                    cmd: 'newlink',
                    ico: 'fas far fa-link mdi mdi-link',
                    title: 'Upload Link'
                }
            }
        }
    },
    computed: {
        compiledMarkdown: function() {

            let clean_md = DOMPurify.sanitize(this.postNewContent); // cleaned data to prevent xss
            return marked(clean_md);
        }
    },
    methods:{
        uploadimage(md){
            let url = prompt("Enter image link");
            md.drawImage({url:`${url}`, title:'Failed to load'});
        },
        newlink(md){
            let url = prompt("Insert link");
            md.drawLink({url:`${url}`, title:`${url}`});
        },
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

    #preview{
        border: 3px solid black;
        position:relative;
    }
    #preview::after{
        content:"预览";
        position:absolute;
        top:-20px;
        right:-3px;
        padding:5px;
        background:black;
        color:white;
    }

    #preview >>> blockquote{
        border-left: 3px solid grey;
        padding-left: 5px;
    }

    #preview >>> img{

        max-width:100%;
    }

    .v-md-toolbar{
        overflow:scroll !important;
    }
</style>
