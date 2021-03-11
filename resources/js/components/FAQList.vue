<template>
    <div class="my-5 px-5">
        <h2 class="text-secondary mt-5">GENERAL</h2>
        <div id="accordion bg-white" style="height:50vh;">
            <div class="faq" v-for="faq in faqs" :key="faq.id">
                <div class="card-header pl-0 d-flex justify-content-between bg-white" data-toggle="collapse" :data-target="`#ans${faq.id}`">
                    <div class="mb-0 question">
                        {{ faq.question }}
                    </div>
                    <div><i class="fa fa-angle-down"></i></div>
                </div>

                <div :id="`ans${faq.id}`" class="collapse answer" aria-labelledby="headingOne">
                    <div class="card-body pl-0" v-html="faq.answer">
                    </div>
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
    .faq{
        max-width: 60%;
    }
    .card-header:hover{
        cursor:pointer;
    }
    .question{
        font-size: 30px;
    }
    .answer{
        font-size:20px;
    }
</style>
