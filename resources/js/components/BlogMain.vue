<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col left pl-0">
                    <h1>欢迎来到学脉部落格</h1>
                </div>

                <div class="col text-right">
                    <a href="/login" class="bg-blue-500 font-bold text-white px-4 py-3 transition duration-300 ease-in-out hover:bg-blue-600 mr-6">
                        点击登录
                    </a>
                    <div class="btn">
                        <a href="/login"></a>
                    </div>
                </div>
            </div>
        </div>
        <small>我们的进度报告，产品发布，都会在这里!</small>

        <AllPosts></AllPosts>
    </div>
</template>

<script>
import AllPosts from "./AllPosts";
export default {
    name: "BlogMain",
    components:{AllPosts},
}
</script>

<style scoped>

</style>
