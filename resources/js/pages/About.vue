<template>
<div>
    <div class="jumbotron d-flex justify-content-center align-items-center" id="motto">
        <div class="display-4 p-5">{{ __('i18n.about.title')}}</div>
    </div>
    <div class="container">
        <div class="jumbotron bg-white">

            {{ __('i18n.about.description') }}

        </div>
    </div>
    <div>
        <div class="container">
            <div class="row">

                <h2>{{ __(`i18n.about.product.title`) }}</h2>

            </div>
            <div class="row">
                <div class="col px-0">
                    <Product></Product>
                </div>
            </div>

        </div>
        <hr>
        <div class="container px-0">
            <div class="row no-gutters">
                <h2>{{ __(`i18n.about.members.title`) }}</h2>
            </div>
            <div class="row no-gutters">
                <div class="col-12 col-md-4" v-for="i in 3">
                    <Member :name="__(`i18n.about.members.${i}.name`)" :info="__(`i18n.about.members.${i}.info`)"></Member>
                </div>
            </div>

        </div>
    </div>
</div>
</template>

<script>
import Member from "../components/Member";
import Product from "../components/Product";
export default {
name: "About",
    components:{Member,Product},
    mounted(){
        console.log(this.lang.getLocale());
    }
}
</script>

<style scoped>
#motto{
    background-image:url("https://images.unsplash.com/photo-1455849318743-b2233052fcff?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80");
    background-size:cover;
}
</style>
