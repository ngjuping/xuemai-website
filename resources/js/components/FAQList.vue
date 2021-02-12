<template>
    <div id="accordion">
        <div class="w-75" v-for="faq in faqs" :key="faq.id">
            <div class="card-header d-flex justify-content-between" data-toggle="collapse" :data-target="`#ans${faq.id}`">
                <div class="mb-0">
                    {{ faq.question }}
                </div>
                <div><i class="fa fa-angle-down"></i></div>
            </div>

            <div :id="`ans${faq.id}`" class="collapse" aria-labelledby="headingOne">
                <div class="card-body">
                    {{ faq.answer }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "FAQList",
    props:["faqs"],
}
</script>

<style scoped>
    .card-header:hover{
        cursor:pointer;
    }

</style>
