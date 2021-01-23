<template>
    <div ref="app_top">
<!--        <router-view/>-->
        <slot></slot>
        <div id="gotoTop" class="shadow d-flex justify-content-center align-items-center" @click="scrollToTop()">
            <i class="fa fa-angle-up"></i>
        </div>
    </div>
</template>
<script>

let smoothScroll = require('smoothscroll');

export default {

    methods:{
        scrollToTop(){
            smoothScroll(this.$refs["app_top"]);
        }
    }
}
</script>

<style>
#gotoTop{
    width:40px;
    height:40px;
    border-radius:15px;
    position:fixed;
    bottom:30px;
    right: 30px;
}
</style>
