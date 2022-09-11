<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3>Blog Post</h3>
                        <form @submit.prevent="store()" enctype="multipart/form-data">
                            <div class="alert alert-success" v-show="success">Post has been saved.</div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter the title" v-model="title">
                                        <span class="text-danger" v-if="msg && msg.title">{{ msg.title[0] }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="decription">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="8" class="form-control" v-model="description"></textarea>
                                         <span class="text-danger" v-if="msg && msg.description">{{ msg.description[0] }}</span>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <img :src="imagePlaceholder" alt="image" class="img-fluid">
                                    <input type="file" @change="updatePreview($event)" ref="image" class="form-control-file">
                                    <span class="text-danger" v-if="msg && msg.image">{{ msg.image[0] }}</span>
                                </div>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" v-model="user_id">
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-dark">Add New Post</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <h3>Posts</h3>
                        <hr>
                        <posts-component v-for="(post,index) in posts" :key="post.id" :post="post" :index="index" :imageplaceholder="post.image"></posts-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PostsComponent from "./PostsComponent";
    export default{
        data(){
            return{
                imagePlaceholder :"/images/noimage.png",
                title :"",
                description:"",
                featured_image:"",
                user_id:1,
                posts:[],
                msg:{},
                success:false,
            }
        },
        computed:{
            imagePreview(){
                return this.featured_image == "" ? this.imagePlaceholder : this.featured_image
            }
        },
        methods:{
            get(){
                axios.get('api/posts')
                .then(response=>{
                    this.posts = response.data
                })
                .catch(error=>{
                    console.log(error)
                })
            },
            store(){
                const form = new FormData()

                form.append("title",this.title)
                form.append("description",this.description)
                form.append("user_id",this.user_id)
                form.append("image",this.$refs.image.files[0])
                
                axios.post('api/post/store',form)
                .then(response=>{
                    this.success = true;
                    this.posts.unshift(response.data)
                    this.title =""
                    this.description=""
                    this.image=""
                    this.msg=null
                })
                .catch(err=>{
                    console.log(err.response.data.error)
                    this.msg = err.response.data.error
                    //alert(this.msg.title)
                })
            },
            updatePreview(event){
                const file = event.target.files[0]
                this.featured_image = URL.createObjectURL(file)
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        components:{
            PostsComponent,
        },
        created(){
            this.get()
        }
    }
</script>