<template>
    <div>
        <div class="jumbotron d-flex align-items-center" id="main_jumbo">
            <div class="container">
                <div class="row">
                    <h1 class="display-4 main_jumbo_title col-12">我们十分愿意聆听。</h1>
                </div>
                <div class="row text-center">
                    <p class="main_jumbo_content col">不论你有什么问题，需要任何关于产品，价钱，技术上帮助，我们的队伍随时待命。</p>
                </div>
                <div class="row spacer">

                </div>
                <div class="row d-flex justify-content-center">
                    <button class="main_jumbo_btn scrollOnClick col" @click="scrollToContact">GET IN TOUCH</button>
                </div>
            </div>
        </div>
        <div class="spacer" id="form_scroll"></div>
        <div class="spacer"></div>

        <div class="wrapper">
            <div class="container" id="form_container">
                <div class="row px-3">
                    <h1>联络我们</h1>
                    <div class="border-top my-3 w-100"></div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-3">
                        <p>Tel: 123-456-7890<br>

                            Fax: 123-456-7890</p>

                        <p>500 Terry Francois St.<br>

                            San Francisco, CA 94158<br>

                            info@mysite.com</p>


                        <div class="border-top my-3 w-50"></div>
                    </div>
                    <div class="col-12 col-sm-9">
                        <form id="contact_form" name="sentMessage" novalidate="novalidate" ref="contact">
                            <div class="row">
                                <div class="col-md-6" id="form_first_part">
                                    <div class="form-group">
                                        <input class="form-control" id="name" type="text" placeholder="名字/Name" v-model="name">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" id="email" type="email" placeholder="邮箱/Email" v-model="email">
                                    </div>

                                </div>
                                <div class="col-md-6 form-group" id="message_container">
                                    <textarea class="form-control h-100" id="message" placeholder="您的信息/Message" v-model="message"></textarea>
                                </div>

                            </div>
                        </form>

                        <div class="text-right d-flex justify-content-end w-100">
                            <div v-if="!disableSubmit">
                                <div class="btn btn-danger btn-xl text-uppercase mx-2" type="submit" @click="report">吐槽</div>
                                <div class="btn btn-primary btn-xl text-uppercase" type="submit" @click="suggest">提议</div>
                                <small class="text-danger" v-if="failedSubmit">{{ err_msg }}</small>
                            </div>
                            <h3 v-else class="text-success">谢谢您的反馈!</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2';
let smoothScroll = require('smoothscroll');

export default {
    name: "Contact",
    data(){
        return {
            name:"",
            email:"",
            message:"",
            disableSubmit:false,
            failedSubmit:false,
            err_msg:"无法提交，请重试"
        }
    },
    methods:{
        scrollToContact(){
            smoothScroll(this.$refs["contact"]);
        },
        checkInputOK(){
            if(this.name.length === 0 || this.name.length > 30){
                this.err_msg = "名字不能为空或太长！"
            }
            else if(this.email.length === 0 || this.email.length > 50){
                this.err_msg = "邮箱不能为空或太长！"
            }
            else if(this.message.length === 0 || this.message.length > 200){
                this.err_msg = "信息不能为空或太长！"
            }
            else return true;

            this.failedSubmit = true;
            return false;
        },
        submitWithType(type){
            if(this.disableSubmit) return;

            if(this.checkInputOK())
            {
                this.failedSubmit = false;
                axios.post('api/feedback',{
                    "author":this.name,
                    "author_email":this.email,
                    "issue":this.message,
                    "importance":3,
                    "type":type,
                    "status":1
                })
                .then((res) => {
                    this.disableSubmit = true;
                    Swal.fire({
                        title: `成功`,
                        text: `受到了您的信息，我们会尽快回复~`,
                        icon:"success",
                        showCloseButton:true,
                        showConfirmButton:true,
                        confirmButtonText:"继续浏览",
                        timer: 1500
                    })
                })
                .catch((err) => {
                    console.log(err);
                    this.failedSubmit = true;
                })
            }

        },
        report(){
            this.submitWithType(1);
        },
        suggest(){
            this.submitWithType(2);
        }
    }
}
</script>

<style scoped>
#main_jumbo
{
    position:relative;
    min-height:50vh;
    text-align:center;
    z-index:0;
}

#main_jumbo::after
{
    content:"";
    width:100%;
    height:100%;
    top:0px;
    left:0px;
    position:absolute;
    z-index:-1;
    opacity:0.5;
    background:url("https://images.unsplash.com/photo-1423666639041-f56000c27a9a?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1353&q=80");
    background-repeat:no-repeat;
    background-size:cover;
}

.main_jumbo_title
{
    font-size:3em;
    z-index:2;
}

.main_jumbo_content
{
    margin-left:5em;
    margin-right:5em;
    font-size:1.5em;
    z-index:2;
}

.main_jumbo_btn
{
    text-align:center;
    border:3px solid black;
    padding:1em;
    z-index:2;
    font-size:1.4em;
    color:black;
    background-color:transparent;
    cursor:pointer;
    max-width:70%;
    transition:background-color 0.5s;
}

.main_jumbo_btn:hover
{
    background-color:white;
}


@media (max-width: 768px)
{
    #main_jumbo::after
    {
        background-size:cover;
    }

    .main_jumbo_content
    {
        margin-left:4em;
        margin-right:4em;
    }
}

@media (max-width: 576px)
{
    #email_container
    {
        margin-bottom:auto;
    }


    .main_jumbo_btn
    {
        font-size:1em;
    }
    .main_jumbo_title
    {
        font-size:2em;
        z-index:2;
    }

    .main_jumbo_content
    {
        font-size:1em;
        margin-left:3em;
        margin-right:3em;
    }
    #sendMessageButton
    {
        width:100%;
    }
}
</style>
