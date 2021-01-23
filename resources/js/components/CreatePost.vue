<template>
    <div>
        <div id="editor">
            <input v-model="postTitle" type="text" class="form-control">
            <br/>
            <textarea v-model="input"></textarea>
            <div v-html="compiledMarkdown"></div>
        </div>
        <a @click="createPost" class="bg-blue-500 font-bold text-white px-4 py-3 transition duration-300 ease-in-out hover:bg-blue-600 mr-6">
            发布
        </a>
    </div>
</template>

<script>
import marked from 'marked';
import DOMPurify from 'dompurify';


export default {
    name: "CreatePost",
    data() {
        return {
            input: "# hello",
            postTitle: "默认标题"
        }
    },
    computed: {
        compiledMarkdown: function() {

            let clean = DOMPurify.sanitize(this.input);
            return marked(clean);
        }
    },
    methods:{
        update(){
            this.$forceUpdate();
        },
        createPost(){
            axios.post('/api/post/create',{
                postTitle:this.postTitle,
                postContent:this.compiledMarkdown
            })
            .then((res) => {
                console.log(res.data);
            })
            .catch((err) => {
                console.log(err);
            })
        }
    }
}
</script>

<style scoped>
    #editor {
        margin: 0;
        height: 100%;
        font-family: "Helvetica Neue", Arial, sans-serif;
        color: #333;
    }

    textarea,
    #editor div {
        display: inline-block;
        width: 49%;
        height: 100%;
        vertical-align: top;
        box-sizing: border-box;
        padding: 0 20px;
        min-height: 400px;
    }

    textarea {
        border: none;
        border-right: 1px solid #ccc;
        resize: none;
        outline: none;
        background-color: #f6f6f6;
        font-size: 14px;
        font-family: "Monaco", courier, monospace;
        padding: 20px;
    }

    code {
        color: #ff6666;
    }

</style>
