<template>
    <div class="row">
        <div class="col-xl-5">
            <div class="card">
                <div class="card-header">
                    <h5>Expense</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>iphone 6</td>
                                <td>
                                    <span>
                                          <button class="btn btn-sm btn-danger m-0" disabled>-</button>
                                          <input type="text"  size="2" disabled>
                                          <button class="btn btn-sm btn-success m-0"> + </button>
                                    </span>
                                </td>
                                <td>10</td>
                                <td>10777</td>
                                <td><button class="btn btn-danger btn-sm">x</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header">
                    <h5>Products</h5>
                </div>
                <div class="card-block table-border-style">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                sfsff
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                sfsff
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                sfsff
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                sfsff
                            </div>
                        </div>
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
