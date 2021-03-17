<template>
    <div class="bg-white" >
        <div class="container-fluid px-0 py-5 px-md-5 bg-light mb-3">
            <div class="row no-gutters px-6 mx-6"   >
                <div class="col-12 col-md">
                    <h3 id="latest_blogs_title" class="px-3">{{ __('i18n.blog.latest') }}</h3>
                </div>
                <div class="col-12 col-md d-flex align-items-center">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control"
                               :placeholder="__('i18n.blog.search')"
                               v-model="filterString"
                               @search="getAllPosts();mode = 'posts';"
                               @input="checkIfQueryIsEmpty">
                        <div class="input-group-append" @click="searchPosts()">
                            <button class="btn btn-outline-secondary" type="button"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="px-0 px-md-5">
            <div class="d-flex justify-content-end px-6 mx-6">
                <div class="mx-3 col" v-if="loading">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <ul class="pagination">
                    <li class="page-item page-link text-dark" @click="getAllPosts(pagination_data.first_page_url)">{{ __('i18n.blog.pagination.first') }}</li>
                    <li class="page-item page-link text-dark" @click="getAllPosts(pagination_data.prev_page_url)" v-if="pagination_data.prev_page_url">{{ __('i18n.blog.pagination.prev') }}</li>
                    <li class="page-item " v-for="page in availablePages" :class="{'active':pagination_data.current_page===page}">
                        <a class="page-link" @click="getAllPosts(`/api/${mode}?page=${page}`)">{{page}}</a>
                    </li>
                    <li class="page-item page-link text-dark" @click="getAllPosts(pagination_data.next_page_url)" v-if="pagination_data.next_page_url">{{ __('i18n.blog.pagination.next') }}</li>
                    <li class="page-item page-link text-dark" @click="getAllPosts(pagination_data.last_page_url)">{{ __('i18n.blog.pagination.last') }}</li>
                </ul>
            </div>
            <div class="mx-6 px-6">
                <Post v-for="post in posts" :key="post.id" :post="post" :readonly="true" @post-clicked="goToPostDetails(post.id)"></Post>
            </div>
        </div>
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
            loading:false,
            mode:"posts"
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
        checkIfQueryIsEmpty(){
              if(!this.filterString) {
                  this.getAllPosts();
                  this.mode = 'posts';
              }
        },
        searchPosts(){
            this.mode = "search";
            this.loading = true;
            axios.get(`/api/search?page=1&query=${this.filterString}`)
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

            // if it is in search mode, append the query everytime
            if(this.mode === 'search'){
                url += `&query=${this.filterString}`;
            }
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

<style scoped>
.px-6{
    padding-left: 10%;
    padding-right: 10%;
}

.mx-6{
    margin-left:10%;
    margin-right:10%;
}
#latest_blogs_title{
    font-size: 50px;
    font-weight: bold;
    font-family: 'Arial Black';
}


.pagination > .active > a
{
    border-color:black;
    color: white;
    background-color: black !Important;
}

@media(max-width:768px){
    .px-6{
        padding-left: 5%;
        padding-right: 5%;
    }

    .mx-6{
        margin-left:5%;
        margin-right:5%;
    }
}

@media(max-width:468px){
    .px-6{
        padding-left: 1%;
        padding-right: 1%;
    }

    .mx-6{
        margin-left:1%;
        margin-right:1%;
    }
}

</style>
