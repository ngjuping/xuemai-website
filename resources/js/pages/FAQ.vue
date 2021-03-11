<template>
    <div class="bg-white">
        <h1 id="FAQ_list_title" class="bg-light p-5">{{ __('i18n.FAQ.title') }}</h1>
        <FAQList :faqs="faqs"></FAQList>
    </div>
</template>

<script>
import FAQList from "../components/FAQList";
export default {
    name: "FAQ",
    components:{FAQList},
    data(){
          return {
              faqs: []
          }
    },
    mounted(){
        axios.get("/api/faqs")
        .then((res) => {
            this.faqs = res.data.faqs;
        })
        .catch((err) => {
            console.log(err);
        })
    }
}
</script>

<style scoped>
#FAQ_list_title{
    font-size:50px;
    font-weight: 900;
    font-family: 'Arial Black';
}

@media(max-width:768px){
    #FAQ_list_title{
        font-size:30px;
        font-weight: 900;
    }
}
</style>
