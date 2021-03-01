<template>
    <div id="indicators" class="carousel slide p-3 rounded" data-ride="carousel">
        <ol class="carousel-indicators mb-1 mt-1">
            <li data-target="#indicators" data-slide-to="0" class="active"></li>
            <li data-target="#indicators" data-slide-to="1"></li>
            <li data-target="#indicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner rounded">
            <div class="carousel-item active">
                <img class="d-block w-100" src="https://www.timeshighereducation.com/sites/default/files/institution/header_image/profile_2017_-_header_-_tsinghua_uni.jpg" alt="First slide">
                <div class="carousel-caption">
                    <div class="display-3 carousel_title">{{ __('i18n.main.news.1.title')}}</div>
                    <div class="display-5 carousel_content">{{ __('i18n.main.news.1.description')}}</div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://news.cgtn.com/news/3049544e7751544f776b7a4e3249444f776b7a4e31457a6333566d54/img/dbc2bed8083940c4a70ca53dc7e784a2/dbc2bed8083940c4a70ca53dc7e784a2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRbIJcKGTnE6VBqugBwSRSPY4r4xw6X1gcY2w&usqp=CAU" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" data-target="#indicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" data-target="#indicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</template>

<script>
export default {
name: "News"
}
</script>

<style scoped>
    .carousel{
        min-height: 300px;
        height:40vw;
        max-height:600px;
    }
    .carousel-inner
    {
        min-height: 300px;
        height:40vw;
        max-height:600px;
    }
    .carousel-item
    {
        min-height: 300px;
        height:40vw;
        max-height:600px;
    }
    .carousel-caption::after
    {
        content:"";
        position:absolute;
        display:block;
        top:0px;
        left:0px;
        width:100%;
        height:100%;
        opacity:0.8;
        z-index:-1;
        background-color:#282829;
    }
    img{
        height:100%;
        object-fit:cover;
    }

    @media (max-width: 768px)
    {
        .carousel_title
        {
            font-size: 30px;
        }
        .carousel_content
        {
            font-size: 15px;
        }

    }
</style>
