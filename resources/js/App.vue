<template>
    <div ref="app_top">

        <VisitorHeader></VisitorHeader>
        <router-view/>
        <div id="gotoTop" class="shadow d-flex justify-content-center align-items-center" @click="scrollToTop()">
            <i class="fa fa-angle-up"></i>
        </div>
        <VisitorFooter></VisitorFooter>
    </div>
</template>
<script>
import VisitorHeader from "./components/VisitorHeader";
import VisitorFooter from "./components/VisitorFooter";
let smoothScroll = require('smoothscroll');

export default {
    components:{VisitorHeader,VisitorFooter},
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
