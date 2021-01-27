<template>
    <div class="p-3">
        <div class="container-fluid">
            <div class="row pl-3">
                <div class="col left pl-0">
                    <h1>欢迎来到学脉</h1>
                </div>

            </div>
        </div>
        <div class="pl-3">
            <small>我们的进度报告，产品发布，都会在这里!</small>
        </div>

        <News></News>
        <AllPosts></AllPosts>
    </div>
</template>

<script>
import AllPosts from "../components/AllPosts";
import VisitorHeader from "../components/VisitorHeader";
import News from "../components/News";

export default {
    name: "BlogMain",
    components:{AllPosts,VisitorHeader,News},
}
</script>

<style scoped>

</style>
