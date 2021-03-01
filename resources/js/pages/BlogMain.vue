<template>
    <div class="p-3">
        <div class="container-fluid">
            <div class="row pl-3">
                <div class="col left pl-0">
                    <h1>{{ __('i18n.main.welcome') }}</h1>
                </div>

            </div>
        </div>
        <div class="pl-3">
            <small>{{ __('i18n.main.welcome-2') }}</small>
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
    mounted(){
        console.log(this.lang.getLocale());
    }
}
</script>

<style scoped>

</style>
