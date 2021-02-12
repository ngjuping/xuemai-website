<template>
    <div id="accordion">
        <div class="card w-100" v-for="faq in faqs" :key="faq.id">
            <div class="card-header">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" :data-target="`#ans${faq.id}`">
                        {{ faq.question }}
                    </button>
                </h5>
            </div>

            <div :id="`ans${faq.id}`" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
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

</style>
