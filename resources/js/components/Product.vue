<template>
    <div class="card mb-4">
        <div class="row no-gutters">
            <div class="col-md-4 p-4">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Google_Chrome_icon_%28September_2014%29.svg/1200px-Google_Chrome_icon_%28September_2014%29.svg.png" class="card-img" alt="XueMai">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ __('i18n.about.product.name')}}</h5>
                    <p class="card-text">{{ __('i18n.about.product.info')}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "Product"
}
</script>

<style scoped>

    img{
        max-width:250px !important;
    }
</style>
