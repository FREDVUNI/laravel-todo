<template>
    <div>
        <div class="form-group">
            <input type="text" name="" class="form-control" placeholder="Enter the item" v-model="item.name">
        </div>
        <div class="from-group">
            <button :class="[item.name ? 'btn btn-dark btn-sm':'btn btn-primary btn-sm']" @click="additem()">Add Item</button>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return{
                item:{
                    name: "",
                }
            }  
        },
        methods:{
            additem(){
                if(this.item.name == ""){
                    return;
                }
                axios.post("api/item/store",{
                    item: this.item
                })
                .then(response =>{
                    if(response.status == 201){
                        this.item.name = ""
                    }
                })
                .catch(error =>{
                    console.log(error)
                })
            }
        }
    }
</script>