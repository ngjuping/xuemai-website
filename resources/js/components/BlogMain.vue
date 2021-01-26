<template>
    <div>
        <VisitorHeader></VisitorHeader>
        <div class="container-fluid">
            <div class="row">
                <div class="col left pl-0">
                    <h1>欢迎来到学脉部落格</h1>
                </div>

            </div>
        </div>
        <small>我们的进度报告，产品发布，都会在这里!</small>

        <AllPosts></AllPosts>
    </div>
</template>

<script>
import AllPosts from "./AllPosts";
import VisitorHeader from "./VisitorHeader";
export default {
    name: "BlogMain",
    components:{AllPosts,VisitorHeader},
}
</script>

<style scoped>

</style>
