<template>
    <div class="bg-light p-3">
        <div v-for="post in posts" :key="post.id" class="jumbptron bg-light p-3">
            <h3>{{ post.postTitle.slice(0,30) }}</h3>
            <div>{{ relativeTime(post.created_at) }}</div>
        </div>
    </div>

</template>

<script>
import moment from 'moment';

export default {
    data(){
        return {
            posts:[]
        }
    },
    methods:{
        relativeTime(time){
            let first_half = time.split("T")[0];
            let second_half_time = time.split("T")[1].split("+")[0];
            return moment(first_half + " " + second_half_time,"YYYY-MM-DD hh:mm:ss").fromNow();
        },

        getAllPosts(){
            console.log("GET")
            axios.get("/api/posts")
                .then((res) => {
                    this.posts = res.data.posts;
                })
                .catch((err) => {
                    console.log(err);
                })
        }
    },
    mounted(){
        this.getAllPosts();
    }
}
</script>
