<template>
    <div class="p-5">
        <h1>{{ __('i18n.FAQ.title') }}</h1>
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

</style>
