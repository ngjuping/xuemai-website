<template>
    <div>
        <div class="btn btn-danger" @click="$router.go(-1)">返回</div>
        <h1 v-if="post"> {{ this.post.postTitle }} </h1>
        <h2 v-else> Loading... </h2>
        <div v-html="compiledMarkdown"></div>
    </div>
</template>

<script>
import DOMPurify from "dompurify";
import marked from "marked";

export default {
    name: "PostDetail",
    data(){
        return{
            post: null
        }
    },
    computed:{
        compiledMarkdown: function() {
            if( !this.post ) return;
            let clean_md = DOMPurify.sanitize(this.post.postContent); // cleaned data to prevent xss
            return marked(clean_md);
        }
    },
    mounted(){
        axios.get(`/api/post/${this.$route.params.id}`)
        .then((res) => {
            this.post = res.data.post;
        })
        .catch((err) => {
            console.log(err);
        })
    }
}
</script>

<style scoped>

</style>
