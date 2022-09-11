<template>
    <div>
        <input type="checkbox" v-model="items.completed" @click="update()">
        <span>{{ items.name }}</span>
    </div>
</template>
<script>
    export default{
        props:["items"]
    }
</script>