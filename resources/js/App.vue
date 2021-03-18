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

.btstrp-custom-px-6{
    padding-left: 10%;
    padding-right: 10%;
}

.btstrp-custom-mx-6{
    margin-left:10%;
    margin-right:10%;
}


@media(max-width:768px){
    .btstrp-custom-px-6{
        padding-left: 5%;
        padding-right: 5%;
    }

    .btstrp-custom-mx-6{
        margin-left:5%;
        margin-right:5%;
    }
}

@media(max-width:468px){
    .btstrp-custom-px-6{
        padding-left: 1%;
        padding-right: 1%;
    }

    .btstrp-custom-mx-6{
        margin-left:1%;
        margin-right:1%;
    }
}

#app > div{
    background-color: white;
}
</style>
