<template>
    <div class="jumbotron bg-light p-3 post shadow" @click="$emit('post-clicked')">
        <h3>{{ post.postTitle.slice(0,50) }}</h3>
        <p> {{ __('i18n.main.published_at') }} {{ parseTime(post.created_at) }}</p>
        <small>{{ post.postContent.slice(0,50) }}... </small>
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
    .post:hover{
        background-color:white !important;
    }
</style>
