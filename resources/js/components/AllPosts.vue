<template>
    <div class="bg-light p-3 mt-4">
        <h3>最新动态</h3>
        <div class="container-fluid px-0 mb-3 mx-0">
            <div class="row">
                <div class="col-8 d-flex justify-content-start">
                    <input class="form-control w-75 h-100 mr-2" type="search" placeholder="搜索帖子..." v-model="filterString" @search="getAllPosts()">
                    <button class="btn btn-primary d-inline-block" @click="searchPosts()">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="col d-flex justify-content-end align-items-end">
                    <div class="mx-3" v-if="loading">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <ul class="pagination">
                        <li class="page-item page-link" @click="getAllPosts()">First</li>
                        <li class="page-item page-link" @click="getAllPosts(pagination_data.prev_page_url)" v-if="pagination_data.prev_page_url">Previous</li>
                        <li class="page-item " v-for="page in availablePages" :class="{'active':pagination_data.current_page===page}">
                            <a class="page-link" @click="getAllPosts(`/api/posts?page=${page}`)">{{page}}</a>
                        </li>
                        <li class="page-item page-link" @click="getAllPosts(pagination_data.next_page_url)" v-if="pagination_data.next_page_url">Next</li>
                        <li class="page-item page-link" @click="getAllPosts(pagination_data.next_page_url)">Last</li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
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
            filterString:"",
            page:1,
            pagination_data:{},
            loading:false
        }
    },
    components:{Post},
    computed:{
        posts(){
            return this.allPosts;
        },
        availablePages(){
            let pages = [];
            let current_page = this.pagination_data.current_page;
            let last_page = this.pagination_data.last_page;
            for(let i=1 ; i<current_page && i-current_page<3 ; i++) pages.push(i);
            for(let i=current_page ; i<=last_page && i-current_page<3 ; i++) pages.push(i);
            return pages;
        }
    },
    methods:{
        searchPosts(){

            this.loading = true;
            axios.get(`/api/search?query=${this.filterString}`)
                .then((res) => {
                    console.log(res.data);
                    this.allPosts = res.data.posts.data;
                    this.pagination_data = res.data.posts;
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(()=>{this.loading=false;})
        },
        getAllPosts(url="/api/posts?page=1"){
            this.loading = true;
            axios.get(url)
                .then((res) => {
                    console.log(res.data);
                    this.allPosts = res.data.posts.data;
                    this.pagination_data = res.data.posts;
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(()=>{this.loading=false;})
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
