<template>
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5>Add New Category</h5>
                </div>
                <div class="card-body">
                    <form enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input name="name" type="text" v-model="form.name" class="form-control" placeholder="Enter Name">
                            <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                        <div class="form-group">
                            <button type="button" @click="createCategory" class="btn btn-square btn-primary float-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5>Category List</h5>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="8" class="text-center" v-if="loading">
                                    <img src="/images/spinner.gif">
                                </td>
                            </tr>
                            <tr v-for="(category, index) in categories">
                                <th scope="row">{{ index+1 }}</th>
                                <td>{{ category.name }}</td>
                                <td>{{ category.created_at }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm" @click="removeCategory(category.id)">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Index",
        data(){
            return {
                categories: [],
                loading: true,
                form:{
                    name : "",
                },
                errors: {},
            }
        },
        mounted(){
            if (!User.loggedIn()) {     //check login or not
                this.$router.push({ name: 'login' });
            }
            this.category();
        },
        methods: {
            category(){
                axios.get('/api/category/list')
                .then(res => {
                    this.loading = false;
                    this.categories = res.data;
                })
                .catch()
            },

            removeCategory(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if(result.isConfirmed){
                        axios.delete('/api/category/delete/'+id)
                        .then(res => {
                            this.categories = this.categories.filter(category => {
                                return category.id !== id;
                            })
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        })
                        .catch(()=>{
                            this.router.push({ path: '/category'});
                        })
                    }
                });
            },

            createCategory(){
                axios.post('/api/category/store', this.form)
                    .then(res => {
                        Toast.fire({
                            icon: 'success',
                            title: 'New category added successfully'
                        })
                        this.category();
                        this.form.name = ''
                    })
                    .catch(error => {
                        this.errors =  error.response.data.errors;
                    })
                /*this.$router.push({ name: 'supplier.index' })*/
            }

        }
    }
</script>

<style scoped>

</style>
