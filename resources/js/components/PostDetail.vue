<template>
    <div>
        <div v-if="post">
            <h1 ><span class="btn btn-danger" @click="$router.go(-1)">返回</span> {{ this.post.postTitle }} </h1>
            <small>发布于 {{ chineseTime(this.post.created_at) }}</small>
        </div>
        <h2 v-else> Loading... </h2>
        <hr>
        <div class="bg-white p-3 shadow" v-html="compiledMarkdown"></div>
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
    methods:{
        chineseTime(fulltime){
            let date = fulltime.split("T")[0].split("-");
            let time = fulltime.split("T")[1].split(".")[0].split(":")
            return `${date[0]}年 ${date[1]}月 ${date[2]}日   ${time[0]}点${time[1]}分`
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
