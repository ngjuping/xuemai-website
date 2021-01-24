<template>
    <div class="bg-light p-3">
        <Post v-for="post in posts" :key="post.id" :post="post" :readonly="true" @post-clicked="goToPostDetails"></Post>
    </div>

</template>

<script>
import moment from 'moment';
import Post from './Post.vue';

export default {
    data(){
        return {
            posts:[]
        }
    },
    components:{Post},
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
        },
        goToPostDetails(){
            this.$router.push({name:'PostDetail',params:{
                    id:this.post.id
                }});
        }
    },
    mounted(){
        this.getAllPosts();
    }
}
</script>
