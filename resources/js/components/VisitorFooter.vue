<template>
<div>
    <div class="container-fluid ">
        <div class="row jumbotron mb-0">
            <div class="col">
                <div class="display-3">
                    <div>Community Vibes</div>
                    <div class="text-primary">discord.gg/xuemai</div>
                </div>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <input type="email" placeholder="Email">
                <div class="btn btn-dark d-inline-block">
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center">Sign up</div>
                </div>
            </div>
        </div>
        <div class="row bg-secondary jumbotron mb-0 rounded-0">
            <div class="col text-white">
                Designed by Xuemai
            </div>
            <div class="col">
                <i class="fab fa-discord mx-3"></i>
                <i class="fab fa-youtube mx-3"></i>
                <i class="fab fa-weixin mx-3"></i>
                <i class="fab fa-github mx-3"></i>
            </div>
            <div class="col text-center">
                <a href="/contact" class="text-white">Contact us</a>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "VisitorFooter"
}
</script>

<style scoped>
    .btn{
        border-radius:0px;
        height:80px;
        width:20%;
    }

    input{
        height:80px;
        width:60%;
    }

    i{
        color:white;
        font-size:30px;
    }
</style>
