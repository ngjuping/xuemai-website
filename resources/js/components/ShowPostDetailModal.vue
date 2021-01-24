<template>
    <div class="modal fade" id="show_post_detail_modal" tabindex="-1" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">帖子内容</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 v-if="post"> {{ this.post.postTitle }} </h1>
                    <h2 v-else> Loading... </h2>
                    <div v-html="compiledMarkdown"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DOMPurify from "dompurify";
import marked from "marked";

export default {
    name: "ShowPostDetailModal",
    props:["post"],
    computed:{
        compiledMarkdown: function() {
            if( !this.post ) return;
            let clean_md = DOMPurify.sanitize(this.post.postContent); // cleaned data to prevent xss
            return marked(clean_md);
        }
    }
}
</script>

<style scoped>

</style>
