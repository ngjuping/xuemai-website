<template>
    <div class="jumbotron bg-white p-3 post" @click="$emit('post-clicked')">
        <h2 class="posttitle">{{ post.postTitle.slice(0,50) }}</h2>
        <small > {{ __('i18n.blog.published_at') }} {{ parseTime(post.created_at) }}</small>
        <p class="postcontent">{{ post.postContent.slice(0,50) }}... </p>
        <div v-if="!readonly" class="my-2">
            <div class="btn btn-primary" @click.stop="$emit('update-post',post)">
                修改
            </div>
            <div class="btn btn-danger" @click.stop="$emit('delete-post',post.id)">
                删除
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "Post",
    props:["post","readonly"],
    methods:{
        localTime(utc){
            return moment.utc(utc).local();
        },
        parseTime(input){
            // Input: 2021-01-25 02:18:06
            // Output: 2021年 01月 25日 02点18分
            let localtime = this.localTime(input).format("YYYY-MM-DD hh:mm");
            let date = localtime.split(" ")[0].split("-");
            let time = localtime.split(" ")[1].split(":")
            return `${date[0]}-${date[1]}-${date[2]}   ${time[0]}:${time[1]}`
        },
    }
}
</script>

<style scoped>
    .post{
        position:relative;
        border: 3px solid transparent;
        cursor:pointer;
    }
    .post:hover{
        border: 3px solid black;
    }
    .posttitle{
        font-size:50px;
        font-weight: 900;
    }
    .postcontent{
        font-size:20px;
    }
    .post:hover::after{
        content:"";
        border-bottom: none;
    }
    .post::after{
        content:"";
        border-bottom: 1px solid grey;
        position:absolute;
        left:0px;
        top:0px;
        width:50%;
        height:100%;
        z-index: -1;
    }

    @media(max-width:768px){
        .posttitle{
            font-size:30px;
            font-weight: 900;
        }
    }
</style>
