<template>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col left pl-0">
                    <h1>欢迎来到学脉部落格</h1>
                </div>

                <div class="col text-right">
                    <div class=" btn btn-primary ">
                        <a href="/login" class="text-white">
                            点击登录
                        </a>
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
