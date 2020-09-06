<template>
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="feather icon-unlock auth-icon"></i>
                    </div>
                    <h3 class="mb-4">Login</h3>
                    <form @submit.prevent="login">
                        <div class="row">
                            <div class="input-group mb-3">
                                <div class="col-md-12">
                                    <input name="email" type="email" class="form-control" placeholder="Email" v-model="form.email">
                                    <small class="text-danger" v-if="errors.email">{{ errors.email[0]}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-4">
                                <div class="col-md-12">
                                    <input name="password" type="password" class="form-control" placeholder="password" v-model="form.password">
                                    <small class="text-danger" v-if="errors.password">{{ errors.password[0]}}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-left">
                            <div class="checkbox checkbox-fill d-inline">
                                <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" checked="">
                                <label for="checkbox-fill-a1" class="cr"> Save Details</label>
                            </div>
                        </div>
                        <button class="btn btn-primary shadow-2 mb-4">Login</button>
                    </form>
                    <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html">Reset</a></p>
                    <p class="mb-0 text-muted">Don’t have an account? <router-link to="/register"> Signup</router-link></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import User from "../../Helpers/User";
    export default{
        name: 'Login',
        data(){
            return{
                form: {
                    email: "",
                    password: ""
                },
                errors: {},
            }
        },
        mounted(){
            if (User.loggedIn()) { 	//check login or not
                this.$router.push({ name: 'home' });
            }
        },
        methods:{
            login(){
                axios.post('/api/auth/login', this.form)
                    .then(res=>{
                        User.responseAfterLogin(res);
                        Toast.fire({
                            icon: 'success',
                            title: 'Login in successfully'
                        })
                        this.$router.push({ name: 'home' });
                    })
                    .catch(error=>{
                        this.errors = error.response.data.errors;
                        //console.log(error.response.data.errors)
                        Toast.fire({
                            icon: 'error',
                            title: 'Username or Password Invalid!!'
                        })

                    })
            }
        }
    }

</script>

<style></style>

