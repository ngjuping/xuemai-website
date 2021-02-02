<template>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow">
        <a class="navbar-brand" href="/">学脉后台</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">主页 <span class="sr-only">(current)</span></a>
                </li>
                <li class="text-white nav-item">
                    <a class="nav-link" href="/">用户视图</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">敬请期待</a>
                </li>
            </ul>
        </div>
        <div>
            <span v-if="logged_in_user" class="text-white mr-3"> 欢迎你！ {{ logged_in_user.name }} </span>
            <span class="btn btn-danger" @click="logout">登出</span>
        </div>
    </nav>
</template>

<script>
export default {
    name: "AdminHeader",
    data(){
      return {
          logged_in_user: null,
      }
    },
    methods:{
        logout(){
            axios.post('/logout')
            .then(() => {
                console.log("Logged out");
                window.location.href = '/';
            })
            .catch((err)=>{
                console.log(err);
            })
        }
    },
    mounted(){
        axios.get("/api/user")
        .then((res) => {
            this.logged_in_user = res.data;
        })
    }
}
</script>

<style scoped>

</style>
