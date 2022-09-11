<template>
    <div>
        <div class="row">
            <div class="col-12 col-sm-4 text-center">
                <img v-if="post.image != ''" 
                    :src="'/images/'+post.image" alt="post.image" class="img-fluid">
                <img v-else 
                    :src="imageplaceholder" alt="post.image">  
            </div>
            <div class="col-12 col-sm-8">
                <h4>{{ post.title }}</h4>
                <p>{{ post.description }}</p>
            </div>
            <div class="col-12 mt-3">
                <a href="" class="btn btn-outline-success btn-sm ">view</a>
                <button class="btn btn-outline-info mr-2 btn-sm">Edit</button>
                <button class="btn btn-outline-danger float-right btn-sm">Delete</button>
                <hr>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props:["imageplaceholder","index","post"],
    }
</script>