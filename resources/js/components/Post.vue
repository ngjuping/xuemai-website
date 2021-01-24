<template>
    <div class="jumbotron bg-light p-3 post shadow" @click="$emit('post-clicked')">
        <h3>{{ post.postTitle.slice(0,30) }}</h3>
        <p> 发布于{{ chineseTime(post.created_at) }}</p>
        <small>{{ relativeTime(post.created_at) }}</small>
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
        relativeTime(time){
            // Input: 2021-01-24T09:26:20.000000Z
            // Output: 4 minutes ago
            let first_half = time.split("T")[0];
            let second_half_time = time.split("T")[1].split(".")[0];
            return moment(first_half + " " + second_half_time,"YYYY-MM-DD hh:mm:ss").fromNow();
        },
        chineseTime(fulltime){
            let date = fulltime.split("T")[0].split("-");
            let time = fulltime.split("T")[1].split(".")[0].split(":")
            return `${date[0]}年 ${date[1]}月 ${date[2]}日   ${time[0]}点${time[1]}分`
        },
    }
}
</script>

<style scoped>
    .post:hover{
        background-color:white !important;
    }
</style>
