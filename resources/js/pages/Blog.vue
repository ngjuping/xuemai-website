<template>
    <div class="">
        <AllPosts></AllPosts>
    </div>
</template>

<script>
import AllPosts from "../components/AllPosts";

export default {
    name: "BlogMain",
    components:{AllPosts},
    mounted(){
        console.log(this.lang.getLocale());
    }
}
</script>

<style scoped>

</style>
