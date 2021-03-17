<template>
<div>
    <div class="container-fluid px-0 px-md-5" id="footer">
        <div class="row no-gutters jumbotron mb-0  px-6 mx-6">
            <div class="col-12 col-md-5 col-lg d-flex align-items-center">
                <div class="row w-100 px-3">
                    <div class="col" id="follow_us_title">
                        {{ __('i18n.footer.follow') }}
                    </div>
                    <div class="col d-flex justify-content-between align-items-center">
                        <i class="fab fa-discord mx-1"></i>
                        <i class="fab fa-youtube mx-1"></i>
                        <i class="fab fa-weixin mx-1"></i>
                        <i class="fab fa-github mx-1"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md col-lg d-flex justify-content-center justify-content-md-end">
                <div class="row w-100">
                    <div class="col-12 d-flex align-items-stretch justify-content-center justify-content-md-end">
                        <input type="email" :placeholder="__('i18n.footer.email')" v-model="subscriber_email">

                        <div :class="{'btn-success':success,'btn-danger':failed, 'btn-dark':!(success || failed)}"
                             class="btn d-inline-flex justify-content-center align-items-center h-100"  @click="subscribe" id="subscribe_btn">
                            <div class="spinner-border " role="status" v-if="subscribing">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="w-100 h-100 d-flex justify-content-center align-items-center" v-else>{{ buttonText }}</div>
                        </div>

                    </div>

                    <div class="col-12">
                        <small :class="{'text-success':success,'text-danger':failed}">{{ err_msg }}</small>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "VisitorFooter",
    data(){
        return {
            subscriber_email: "",
            subscribing:false,
            subscribe_success:false,
            tried_subscribe:false,
            err_msg:""
        }
    },
    methods:{
        subscribe(){
            // prevent spam
            if(this.success){
                return;
            }

            this.subscribing = true;
            this.tried_subscribe = true;
            this.err_msg = "";

            axios.post('/api/subscribe',{
                'email':this.subscriber_email
            })
            .then((res) => {
                this.subscribe_success = true;
                this.err_msg = "Thanks for joining us!";
            })
            .catch((err) => {
                this.subscribe_success = false;
                this.err_msg = err.response.data.errors.email[0];
            })
            .finally(() => {
                this.subscribing = false
            })
        }
    },
    computed:{
        success(){
            return this.tried_subscribe && this.subscribe_success && !this.subscribing;
        },
        failed(){
            return this.tried_subscribe && !this.subscribe_success && !this.subscribing;
        },
        buttonText(){
            if (this.success){
                return 'Thanks';
            }
            else if(this.failed){
                return 'Try again';
            }
            else{
                return __('i18n.footer.signup');
            }
        }
    }
}
</script>

<style scoped>
    #footer{
        background-image: linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);
    }

    .jumbotron{
        background-color:transparent;
    }
    #follow_us_title{
        font-size: 20px;
        color:white;
        font-weight: 800;
    }
    #subscribe_btn{
        border-radius: 0 10px 10px 0;
        background-color: #a664fa;
    }
    .btn{
        border-radius:0px;
        border-color:transparent;
        height:80px;
        width:20%;
    }

    input{
        width:70%;
        border-width: 0px;
        border-radius: 10px 0 0 10px;
        padding-left:20px;

    }
    input:focus{

        border-width: 0px;
    }

    i{
        color:white;
        font-size:30px;
    }

    ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
        white-space:pre-line;
        position:relative;
        top:-7px;
    }
</style>
