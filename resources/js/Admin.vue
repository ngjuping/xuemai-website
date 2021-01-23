<template>
    <div class="p-4 bg-white">
        <h1>管理员界面</h1>
        <p>所有帖子</p>
        <AllPosts></AllPosts>
        <p>创建帖子</p>
        <CreatePost></CreatePost>
    </div>
</template>

<script>
import AllPosts from './components/AllPosts.vue';
import CreatePost from './components/CreatePost.vue';
export default {
    name: "Admin",
    components:{AllPosts,CreatePost}
}
</script>

<style scoped>

</style>
