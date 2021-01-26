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
        localTime(utc){
            return moment.utc(utc).local();
        },
        relativeTime(time){
            // Input: 2021-01-24 09:26:20
            // Output: 4 minutes ago
            // moment.utc(String) parses your string as UTC, moment(date).utc() converts your moment instance to UTC mode
            return this.localTime(time).fromNow();
        },
        chineseTime(input){
            // Input: 2021-01-25 02:18:06
            // Output: 2021年 01月 25日 02点18分
            let localtime = this.localTime(input).format("YYYY-MM-DD hh:mm");
            console.log(localtime);
            let date = localtime.split(" ")[0].split("-");
            let time = localtime.split(" ")[1].split(":")
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
