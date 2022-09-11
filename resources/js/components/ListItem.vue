<template>
    <div>
        <div v-for="(item,index) in items" :key="index">
        <list-view :items="item" class="list-group-item mt-2"/>
    </div>
    </div>
</template>
<script>
    import ListView from "./ListView"
    export default{
        props:["items"],
        components:{
            ListView,
        }
    }
</script>