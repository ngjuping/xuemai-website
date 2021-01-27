<template>
    <div class="bg-light p-3 mt-4">
        <h3>最新动态</h3>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="搜索帖子..." v-model="filterString">
        </form>
        <br/>
        <Post v-for="post in posts" :key="post.id" :post="post" :readonly="true" @post-clicked="goToPostDetails(post.id)"></Post>
    </div>

</template>

<script>
import moment from 'moment';
import Post from './Post.vue';

export default {
    data(){
        return {
            allPosts:[],
            filterString:""
        }
    },
    components:{Post},
    computed:{
        posts(){
            return this.allPosts.filter((post) => {return post.postTitle.includes(this.filterString) || post.postContent.includes(this.filterString)});
        }
    },
    methods:{

        getAllPosts(){
            axios.get("/api/posts")
                .then((res) => {
                    this.allPosts = res.data.posts;
                })
                .catch((err) => {
                    console.log(err);
                })
        },
        goToPostDetails(id){
            this.$router.push({name:'PostDetail',params:{
                    id
                }});
        }
    },
    mounted(){
        this.getAllPosts();
    }
}
</script>
