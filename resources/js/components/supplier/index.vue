<template>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5>Supplier List</h5>
            </div>
            <div class="card-block table-border-style">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>NID</th>
                            <th>Address</th>
                            <th>Joining Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="8" class="text-center" v-if="loading">
                                <img src="/images/spinner.gif">
                            </td>
                        </tr>
                        <tr v-for="(supplier, index) in suppliers">
                            <th scope="row">{{ index+1 }}</th>
                            <td>{{ supplier.name }}</td>
                            <td>{{ supplier.email }}</td>
                            <td>{{ supplier.phone }}</td>
                            <td>{{ supplier.nid }}</td>
                            <td>{{ supplier.address }}</td>
                            <td>{{ supplier.joining_date }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" @click="updateEmployee(supplier.id)">Edit</button>
                                <button class="btn btn-danger btn-sm" @click="removeEmployee(supplier.id)">Delete</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
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
                suppliers: [],
                loading: true
            }
        },
        mounted(){
            if (!User.loggedIn()) {     //check login or not
                this.$router.push({ name: 'login' });
            }
            this.supplier();
        },
        methods: {
            supplier(){
                axios.get('/api/supplier/list')
                .then(res => {
                    this.loading = false;
                    this.suppliers = res.data;
                })
                .catch()
            },

            removeEmployee(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if(result){
                        axios.delete('/api/supplier/delete/'+id)
                        .then(res => {
                            this.suppliers = this.suppliers.filter(supplier => {
                                return supplier.id !== id;
                            })
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        })
                        .catch(()=>{
                            this.router.push({ path: '/supplier'});
                        })
                    }
                });
            },

            updateEmployee(supplier_id){

            }
        }
    }
</script>

<style scoped>

</style>
