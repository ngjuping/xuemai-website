<template>
    <div ref="app_top">

        <VisitorHeader @i18n="updateChildComponents()"></VisitorHeader>
        <router-view :key="'body' + reload"/>
        <div id="gotoTop" class="shadow d-flex justify-content-center align-items-center" @click="scrollToTop()">
            <i class="fa fa-angle-up"></i>
        </div>
        <VisitorFooter :key="'footer'+reload"></VisitorFooter>
    </div>
</template>
<script>
import VisitorHeader from "./components/VisitorHeader";
import VisitorFooter from "./components/VisitorFooter";
let smoothScroll = require('smoothscroll');

export default {
    components:{VisitorHeader,VisitorFooter},
    data(){
        return {
            reload:false
        }
    },
    methods:{
        scrollToTop(){
            smoothScroll(this.$refs["app_top"]);
        },
        updateChildComponents(){
            this.reload = !this.reload;
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
    z-index:100;
    background-color:white;
}

#gotoTop:hover{
    cursor:pointer;
}

#app > div{
    background-color: white;
}
</style>
