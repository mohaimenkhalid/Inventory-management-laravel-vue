<template>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5>Employee List</h5>
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
                        <tr v-for="(employee, index) in employees">
                            <th scope="row">{{ index+1 }}</th>
                            <td>{{ employee.name }}</td>
                            <td>{{ employee.email }}</td>
                            <td>{{ employee.phone }}</td>
                            <td>{{ employee.nid }}</td>
                            <td>{{ employee.address }}</td>
                            <td>{{ employee.joining_date }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm">Edit</button>
                                <button class="btn btn-danger btn-sm" @click="removeEmployee(employee.id)">Delete</button>
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
                employees: [],
                loading: true
            }
        },
        mounted(){
            if (!User.loggedIn()) {     //check login or not
                this.$router.push({ name: 'login' });
            }
            this.employee();
        },
        methods: {
            employee(){
                axios.get('/api/employee/list')
                .then(res => {
                    this.loading = false;
                    this.employees = res.data;
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
                        axios.delete('/api/employee/delete/'+id)
                        .then(res => {
                            this.employees = this.employees.filter(employee => {
                                return employee.id !== id;
                            })
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        })
                        .catch(()=>{
                            this.router.push({ path: '/employee'});
                        })
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
