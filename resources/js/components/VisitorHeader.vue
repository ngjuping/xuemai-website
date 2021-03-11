<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white">
        <a class="navbar-brand" href="/">{{ __('i18n.header.brand') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/about">{{ __('i18n.header.about_us') }}</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/contact">{{__('i18n.header.contact_us') }}</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/blog">{{ __('i18n.header.blog') }}</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/faq">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">{{ __('i18n.header.incoming') }}</a>
                </li>
            </ul>
        </div>
        <div class="btn-group ">
            <div class="btn btn-light" @click="setLang('en')">English</div>
            <div class="btn btn-light" @click="setLang('zh')">简体中文</div>
        </div>
    </nav>
</template>

<script>
export default {
name: "VisitorHeader",
    methods:{
        setLang(locale){
            this.lang.setLocale(locale);
            localStorage.setItem('xuemai-locale',locale),
            this.$emit('i18n');
            this.$forceUpdate();
        }
    }
}
</script>

<style scoped>
nav{
    position:sticky;
    top:0px;
    z-index:100;
}

a{
    font-size:20px;
}
</style>
