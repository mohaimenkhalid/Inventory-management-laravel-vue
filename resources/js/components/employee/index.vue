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
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" @click="editEmployee(employee.id)">Edit</button>
                                <button class="btn btn-danger btn-sm" @click="removeEmployee(employee.id)">Delete</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--modal-->
        <div class="modal-rapper">
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Modal Body -->
                            <form enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="text" v-model="form.name" class="form-control" placeholder="Enter Name">
                                    <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="text" v-model="form.email" class="form-control" placeholder="Enter Email">
                                    <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label>Phone No</label>
                                    <input name="phone" type="number" v-model="form.phone" class="form-control" placeholder="Enter Phone No">
                                    <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender" v-model="form.gender">
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <small class="text-danger" v-if="errors.gender">{{ errors.gender[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input name="address" type="text" v-model="form.address" class="form-control" placeholder="Enter Address">
                                    <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label>Salary</label>
                                    <input name="salary" type="number" v-model="form.salary" class="form-control" placeholder="Enter Salary">
                                    <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label>NID</label>
                                    <input name="nid" type="text" v-model="form.nid" class="form-control" placeholder="Enter National ID Card No">
                                    <small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <label>Joining Date</label>
                                    <input name="joining_date" type="date" v-model="form.joining_date" class="form-control" id="joining_date" placeholder="YYYY-MM-DD">
                                    <small class="text-danger" v-if="errors.joining_date">{{ errors.joining_date[0] }}</small>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-square btn-primary float-right" @click="updateEmployee()">Submit</button>
                                </div>
                            </form>
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
                employees: [],
                loading: true,
                form:{
                    id : "",
                    name : "",
                    email : "",
                    phone : "",
                    salary: "",
                    gender: "",
                    address: "",
                    nid: "",
                    joining_date: "",
                },
                employee_id: 0,
                errors: {},
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
                    if(result.isConfirmed){
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
            },
            editEmployee(employee_id){
                this.employee_id = employee_id;
                axios.get('/api/employee/edit/'+employee_id)
                .then(res => {
                    this.form = res.data;
                })
            },
            updateEmployee(){
                axios.post('/api/employee/update/'+this.employee_id, this.form)
                .then(res => {
                    this.employee();
                    $('#exampleModal').modal('hide')
                    $('.modal-backdrop').remove();

                    if (res.data.success){
                        Toast.fire({
                            icon: 'success',
                            title: res.data.success
                        })
                    }

                })
                .catch(error => {
                    this.errors =  error.response.data.errors;
                })
            },
        }
    }
</script>

<style scoped>

</style>
