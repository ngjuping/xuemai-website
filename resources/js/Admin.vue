<template>
    <div>
        <AdminHeader></AdminHeader>
        <div class="p-3 mx-3">
            <div class="container-fluid p-0 mx-0 my-4">
                <div class="row">
                    <div class="col-12 col-md text-left">
                        <h1>管理帖子</h1>
                    </div>
                    <div class="col-12 col-md d-flex justify-content-md-end">
                        <!-- Might be bad design here, #create_post_modal lies inside CreatePostModal component -->

                        <form class="form-inline">
                            <input class="form-control mr-sm-2" type="search" placeholder="查找" v-model="filterString">
                        </form>

                        <button class="btn btn-outline-primary my-2" data-toggle="modal" data-target="#create_post_modal">创建帖子</button>

                    </div>
                </div>
            </div>
            <ul class="pagination">
                <li class="page-item page-link" @click="getAllPosts(pagination_data.first_page_url)">First</li>
                <li class="page-item page-link" @click="getAllPosts(pagination_data.prev_page_url)" v-if="pagination_data.prev_page_url">上一页</li>
                <li class="page-item " v-for="page in availablePages" :class="{'active':pagination_data.current_page===page}">
                    <a class="page-link" @click="getAllPosts(`/api/${mode}?page=${page}`)">{{page}}</a>
                </li>
                <li class="page-item page-link" @click="getAllPosts(pagination_data.next_page_url)" v-if="pagination_data.next_page_url">下一页</li>
                <li class="page-item page-link" @click="getAllPosts(pagination_data.last_page_url)">Last</li>
            </ul>
            <div class="bg-light">
                <Post v-for="post in posts" :key="post.id" :post="post"
                      :readonly="false"
                      @delete-post="deletePost"
                      @update-post="updatePost"
                      @post-clicked="showPostDetails(post)"></Post>
            </div>
            <CreatePostModal @post-created="getAllPosts"></CreatePostModal>
            <UpdatePostModal :post="postToUpdate" @post-updated="getAllPosts"></UpdatePostModal>
            <ShowPostDetailModal :post="postToShowDetail"></ShowPostDetailModal>
        </div>
    </div>
</template>

<script>
import AllPosts from './components/AllPosts.vue';
import CreatePostModal from './components/CreatePostModal.vue';
import UpdatePostModal from "./components/UpdatePostModal";
import ShowPostDetailModal from "./components/ShowPostDetailModal";
import AdminHeader from "./components/AdminHeader";
import Post from './components/Post.vue';
import Swal from 'sweetalert2';

export default {
    name: "Admin",
    components:{AllPosts,CreatePostModal,Post,UpdatePostModal,ShowPostDetailModal,AdminHeader},
    data(){
        return{
            allPosts:[],
            postToUpdate: null, // post to be updated
            postToShowDetail: null,
            filterString:"",
            page:1,
            pagination_data:{},
            mode:'posts'
        }
    },
    computed:{
        posts(){
            return this.allPosts.filter((post) => {return post.postTitle.includes(this.filterString) || post.postContent.includes(this.filterString)});
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
        getAllPosts(url="/api/posts?page=1"){
            axios.get(url)
                .then((res) => {
                    console.log(res.data);
                    this.allPosts = res.data.posts.data;
                    this.pagination_data = res.data.posts;
                })
                .catch((err) => {
                    console.log(err);
                })
        },
        showPostDetails(post){
            this.postToShowDetail = post;
            // Might be bad design here, #show_post_detail_modal lies inside ShowPostDetailModal component
            $('#show_post_detail_modal').modal('show');
        },
        deletePost(post_id){
            Swal.fire({
                title: '是否确定删除帖子',
                text: "该行动将无法撤回！",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                cancelButtonText: '取消',
                confirmButtonText: '确认',
                preConfirm:()=> {
                    return axios
                        .delete(`/api/post/${post_id}`)
                        .then(() =>
                        {
                            Swal.fire({
                                title:'删除成功!',
                                text:'已将帖子删除',
                                icon:'success',
                                timer:1000}
                            )
                            .then(() => {
                                this.getAllPosts();
                            })
                        })
                        .catch((err)=>{
                            try{
                                Swal.showValidationMessage(
                                    `请求失败: ${err.response.data.message}`
                                )
                            }
                            catch(e){
                                Swal.showValidationMessage(
                                    `无法解析错误信息`
                                )
                            }
                        })

                }
            })
        },
        updatePost(post){
            this.postToUpdate = post;
            // Might be bad design here, #update_post_modal lies inside UpdatePostModal component
            $('#update_post_modal').modal('show');
        }
    },
    mounted(){
        this.getAllPosts();
    }
}
</script>

<style>

</style>
