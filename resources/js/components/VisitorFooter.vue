<template>
<div>
    <div class="container-fluid ">
        <div class="row jumbotron mb-0">
            <div class="col-12 col-md">
                <div id="discord">
                    <div>{{ __('i18n.footer.vibes') }}</div>
                    <div class="text-primary">discord.gg/xuemai</div>
                </div>
            </div>
            <div class="col-12 col-md d-flex align-items-center">
                <div class="row w-100">
                    <div class="col-12">
                        <input type="email" :placeholder="__('i18n.footer.email')" v-model="subscriber_email">

                        <div :class="{'btn-success':success,'btn-danger':failed, 'btn-dark':!(success || failed)}"
                             class="btn d-inline-flex justify-content-center align-items-center"  @click="subscribe" >
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
        <div class="row bg-secondary jumbotron mb-0 rounded-0">
            <div class="col-12 col-md mb-3 text-white">
                Designed by Xuemai
            </div>
            <div class="col-12 col-md mb-3">
                <i class="fab fa-discord mx-2"></i>
                <i class="fab fa-youtube mx-2"></i>
                <i class="fab fa-weixin mx-2"></i>
                <i class="fab fa-github mx-2"></i>
            </div>
            <div class="col">
                <a href="/contact" class="text-white">Contact us</a>
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
    #discord{
        font-size:30px;
    }
    .btn{
        border-radius:0px;
        border-color:transparent;
        height:80px;
        width:20%;
    }

    input{
        height:80px;
        width:70%;
    }

    i{
        color:white;
        font-size:30px;
    }
</style>
