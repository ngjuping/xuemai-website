<template>
    <div class="card mb-4">
        <img class="card-img-top" src="https://thispersondoesnotexist.com/image" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{ name }}</h5>
            <p class="card-text">{{ info }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "Member",
    props:["name","info"]
}
</script>

<style scoped>
</style>
