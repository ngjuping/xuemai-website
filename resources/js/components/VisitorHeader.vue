<template>
    <div>
        <div id="notice" class="container-fluid py-1">
            <div class="row">
                <div class="col text-white pl-3">
                    {{ __('i18n.header.welcome') }}
                </div>
                <div class="col d-flex justify-content-end pr-3">
                    <div class="dropdown">
                        <div class="dropdown-toggle text-white" data-toggle="dropdown">
                            {{ activeLanguage() }}
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item" @click="setLang('en')">English</div>
                            <div class="dropdown-item" @click="setLang('zh')">简体中文</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <a class="navbar-brand" href="/" @click="setActive(0)"><img src="/img/logo.jpg"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item" :class="{'active':isActive(1)}" @click="setActive(1)">
                        <a class="nav-link" href="/about">{{ __('i18n.header.about_us') }}</a>
                    </li>
                    <li class="nav-item" :class="{'active':isActive(2)}" @click="setActive(2)">
                        <a class="nav-link" href="/contact">{{__('i18n.header.contact_us') }}</a>
                    </li>
                    <li class="nav-item" :class="{'active':isActive(3)}" @click="setActive(3)">
                        <a class="nav-link" href="/blog">{{ __('i18n.header.blog') }}</a>
                    </li>
                    <li class="nav-item" :class="{'active':isActive(4)}" @click="setActive(4)">
                        <a class="nav-link" href="/faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">{{ __('i18n.header.incoming') }}</a>
                    </li>
                </ul>

            </div>
        </nav>
    </div>
</template>

<script>
export default {
name: "VisitorHeader",
    methods:{
        activeLanguage(){
            let lang = this.activeLanguageShort();
            switch(lang){
                case 'zh':
                    return '中文';
                case 'en':
                    return 'English';
            }
            return 'English';
        },
        activeLanguageShort(){
            return localStorage.getItem('xuemai-locale');
        },
        setLang(locale){
            this.lang.setLocale(locale);
            localStorage.setItem('xuemai-locale',locale),
            this.$emit('i18n');
            this.$forceUpdate();
        },
        setActive(panel){
            sessionStorage.setItem('active',panel);
        },
        isActive(panel){
            return sessionStorage.getItem('active') == panel;
        }
    }
}
</script>

<style scoped>

#notice{
    background-color: #a664fa;
}
nav{
    position:sticky;
    top:0px;
    z-index:100;
}

a{
    font-size:20px;
}

.nav-item{
    padding:20px;
}

.active{
    border-bottom: 3px solid #a664fa;

}

.active a{
    color: #a664fa !important;
}

img{
    max-width:60px;
}
</style>
