<template>
    <div ref="app_top">

        <VisitorHeader></VisitorHeader>
        <router-view/>
        <div id="gotoTop" class="shadow d-flex justify-content-center align-items-center" @click="scrollToTop()">
            <i class="fa fa-angle-up"></i>
        </div>
    </div>
</template>
<script>
import VisitorHeader from "./components/VisitorHeader";
let smoothScroll = require('smoothscroll');

export default {
    components:{VisitorHeader},
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

#gotoTop:hover{
    background-color:white;
    cursor:pointer;
}
</style>
