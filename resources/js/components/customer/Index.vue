<template>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5>Customer List</h5>
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
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="8" class="text-center" v-if="loading">
                                <img src="/images/spinner.gif">
                            </td>
                        </tr>
                        <tr v-for="(customer, index) in customers">
                            <th scope="row">{{ index+1 }}</th>
                            <td>{{ customer.name }}</td>
                            <td>{{ customer.email }}</td>
                            <td>{{ customer.phone }}</td>
                            <td>{{ customer.nid }}</td>
                            <td>{{ customer.address }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" @click="updateCustomer(customer.id)">Edit</button>
                                <button class="btn btn-danger btn-sm" @click="removeCustomer(customer.id)">Delete</button>
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
                customers: [],
                loading: true
            }
        },
        mounted(){
            if (!User.loggedIn()) {     //check login or not
                this.$router.push({ name: 'login' });
            }
            this.customer();
        },
        methods: {
            customer(){
                axios.get('/api/customer/list')
                    .then(res => {
                        this.loading = false;
                        this.customers = res.data;
                    })
                    .catch()
            },

            removeCustomer(id){
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
                        axios.delete('/api/customer/delete/'+id)
                            .then(res => {
                                this.customers = this.customers.filter(customer => {
                                    return customer.id !== id;
                                })
                                Swal.fire(
                                    'Deleted!',
                                    'Your data has been deleted.',
                                    'success'
                                )
                            })
                            .catch(()=>{
                                this.router.push({ path: '/customer'});
                            })
                    }
                });
            },

            updateCustomer(customer_id){

            }
        }
    }
</script>

<style scoped>

</style>
