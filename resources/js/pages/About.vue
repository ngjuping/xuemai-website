<template>
<div>
    <div class="jumbotron d-flex justify-content-center align-items-center" id="motto">
        <div class="display-4 p-5">一个专注为学术打造的社交平台</div>
    </div>
    <div class="container">
        <div class="jumbotron bg-white">

            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
            when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
            and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

        </div>
    </div>
    <div>
        <div class="container">
            <div class="row">

                <h2>产品</h2>

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
                <h2>团队</h2>
            </div>
            <div class="row no-gutters">
                <div class="col-12 col-md-4">
                    <Member></Member>
                </div>
                <div class="col-12 col-md-4">
                    <Member></Member>
                </div>
                <div class="col-12 col-md-4">
                    <Member></Member>
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
    components:{Member,Product}
}
</script>

<style scoped>
#motto{
    background-image:url("https://images.unsplash.com/photo-1455849318743-b2233052fcff?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80");
    background-size:cover;
}
</style>
