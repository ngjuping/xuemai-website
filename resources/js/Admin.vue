<template>
    <div class="p-4 bg-white">
        <h1>管理员界面</h1>
        <AllPosts></AllPosts>
    </div>
</template>

<script>
import AllPosts from './components/AllPosts.vue';
export default {
    name: "Admin",
    components:{AllPosts}
}
</script>

<style scoped>

</style>
