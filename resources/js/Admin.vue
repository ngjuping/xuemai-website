<template>
    <div class="p-4">
        <h1>管理员界面</h1>
        <div class="container-fluid p-0 mx-0">
            <div class="row">
                <div class="col text-left">
                    <span class="col">所有帖子</span>
                </div>
                <div class="col text-right">
                    <!-- Might be bad design here, #create_post_modal lies inside CreatePostModal component -->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#create_post_modal">创建帖子</button>
                </div>
            </div>
        </div>
        <div class="bg-light p-3">
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
</template>

<script>
import AllPosts from './components/AllPosts.vue';
import CreatePostModal from './components/CreatePostModal.vue';
import UpdatePostModal from "./components/UpdatePostModal";
import ShowPostDetailModal from "./components/ShowPostDetailModal";
import Post from './components/Post.vue';
import Swal from 'sweetalert2';

export default {
    name: "Admin",
    components:{AllPosts,CreatePostModal,Post,UpdatePostModal,ShowPostDetailModal},
    data(){
        return{
            posts:[],
            postToUpdate: null, // post to be updated
            postToShowDetail: null
        }
    },
    methods:{
        getAllPosts(){
            axios.get("/api/posts")
                .then((res) => {
                    this.posts = res.data.posts;
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

<style scoped>

</style>
