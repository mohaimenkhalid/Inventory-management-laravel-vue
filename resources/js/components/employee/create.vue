<template>
    <div>
        <div class="row">
            <div class="col-sm-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Add New Employee</h5>
                    </div>
                    <div class="card-body">
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
                                <input name="phone" type="number" v-model="form.phone" class="form-control" placeholder="Enter Email">
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
                                <button type="button" @click="createEmployee" class="btn btn-square btn-primary float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import User from "../../Helpers/User";
    export default {
        name: 'Login',
        data(){
            return{
                form:{
                    name : "",
                    email : "",
                    phone : "",
                    salary: "",
                    gender: "",
                    address: "",
                    nid: "",
                    joining_date: "",
                },
                errors: {},
            }
        },
        mounted() {
            if (!User.loggedIn()) { 	//check login or not
                this.$router.push({name: 'login'});
            }
        },
        methods: {

            onFileSelected(event){
                let file = event.target.files[0];
                let reader = new FileReader();
                reader.onload = event => {
                    this.form.photo = event.target.result;
                }
                reader.readAsDataURL(file);
            },

            createEmployee(){
                console.log(this.form.joining_date);
                axios.post('/api/employee/store', this.form)
                .then(res => {
                    Toast.fire({
                        icon: 'success',
                        title: 'New employee added successfully'
                    })
                    this.$router.push({ name: 'employee.index' })
                })
                .catch(error => {
                    this.errors =  error.response.data.errors;
                })
                /*this.$router.push({ name: 'employee.index' })*/
            }
        }
    }
</script>
