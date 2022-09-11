<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Todo List</div>

                    <div class="card-body">
                        <add-item-form/>
                        <list-item :items="items"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AddItemForm from "./AddItemForm"
    import ListItem from "./ListItem"
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return{
                items:[]
            }
        },
        components:{
            AddItemForm,
            ListItem
        },
        methods:{
            getList(){
                axios.get("api/items")
                .then(response =>{
                    this.items = response.data
                })
                .catch(error=>{
                    console.log(error)
                })
            }
        },
        created(){
            this.getList()
        }
    }
</script>
