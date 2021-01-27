<template>
    <nav class="navbar navbar-expand-md navbar-dark bg-secondary">
        <a class="navbar-brand" href="/">学脉</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">主页 <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/about">关于我们</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/contact">联络我们</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">敬请期待</a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
name: "VisitorHeader"
}
</script>

<style scoped>
</style>
