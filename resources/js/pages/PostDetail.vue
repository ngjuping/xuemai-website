<template>
    <div class="btstrp-custom-px-6 btstrp-custom-mx-6 mb-3">
        <div v-if="post">
            <div class="text-center">
                <span class="btn float-left return my-3" @click="$router.go(-1)"><i class="fas fa-home"></i></span>
                <div class="clearfix showBelowMD"></div>
                <h1 class="posttitle">{{ this.post.postTitle }}</h1>
             </div>
            <div class="clearfix"></div>
            <div class="jumbotron px-0 py-2 bg-light">
                <div class="container-fluid">
                    <div class="row no-gutters">
                        <div class="col">
                            <i class="fas fa-link mr-2"></i><b>{{ window.location.href }}</b>
                        </div>
                        <div class="col text-right">
                            <small>{{ __('i18n.post.published_at') }} {{ chineseTime(this.post.created_at) }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 v-else> Loading... </h2>
        <div class="bg-white p-3" v-html="compiledMarkdown" id="display"></div>
        <div class="jumbotron px-0 py-1" style="background-color:#a664fa;opacity:0.2;"></div>
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
            if(!fulltime) return '没有创建时间'
            // Input: 2021-01-25 02:18:06
            // Output: 2021年 01月 25日 02点18分
            let date = fulltime.split(" ")[0].split("-");
            let time = fulltime.split(" ")[1].split(":")
            return `${date[0]}年 ${date[1]}月 ${date[2]}日   ${time[0]}点${time[1]}分`
        },
    },
    computed:{
        compiledMarkdown: function() {
            if( !this.post ) return;
            let clean_md = this.post.postContent; // cleaned data to prevent xss
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
.return{
    background-color: #a664fa;
    color:white;
    vertical-align: middle;
}
.posttitle{
    font-weight: bold;
    font-size: 50px;
}
#display >>> blockquote{
    border-left: 3px solid grey;
    padding-left: 5px;
}

#display >>> p{

    font-size: 15px;
}
#display >>> li{

    font-size: 20px;
}
#display >>> table *{

    font-size: 20px;
}

#display >>> td, #display >>> th{
    border: 1px solid grey !important;
}

.showBelowMD{
    display:none;
}

@media(max-width:768px){
    .showBelowMD{
        display:block;
    }
}
</style>
