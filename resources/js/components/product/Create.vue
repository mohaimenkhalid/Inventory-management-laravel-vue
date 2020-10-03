<template>
    <div>
        <div class="row">
            <div class="col-sm-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Add New Product</h5>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input name="name" type="text" v-model="form.name" class="form-control" placeholder="Enter Product Name">
                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Product Code</label>
                                <input name="name" type="text" v-model="form.product_code" class="form-control" placeholder="Enter Product Code">
                                <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                            </div>

                            <div class="form-group">
                                <label>Product Quantity</label>
                                <input name="quantity" type="text" v-model="form.quantity" class="form-control" placeholder="Enter Product Quantity">
                                <small class="text-danger" v-if="errors.quantity">{{ errors.quantity[0] }}</small>
                            </div>

                            <div class="form-group">
                                <label>Product Buying Price</label>
                                <input name="name" type="text" v-model="form.buying_price" class="form-control" placeholder="Enter Buying Price">
                                <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Product Selling Price</label>
                                <input name="name" type="text" v-model="form.selling_price" class="form-control" placeholder="Enter Selling Price">
                                <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Product Category</label>
                                <select class="form-control" name="category_id" v-model="form.category_id">
                                    <option value="" selected disabled>Select product Category</option>
                                    <option :value="category.id" v-for="category in categories">{{ category.name }}</option>
                                </select>
                                <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                            </div>
                            <div class="form-group">
                                <label>Supplier</label>
                                <select class="form-control" name="supplier_id" v-model="form.supplier_id">
                                    <option value="" disabled selected>Select Supplier</option>
                                    <option :value="supplier.id" v-for="supplier in suppliers">{{ supplier.name }}</option>
                                </select>
                                <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
                            </div>

                            <div class="form-group">
                                <label>Buying Date</label>
                                <input name="joining_date" type="date" v-model="form.buying_date" class="form-control" id="joining_date" placeholder="YYYY-MM-DD">
                                <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
                            </div>
                            <div class="form-group">
                                <button type="button" @click="storeProduct" class="btn btn-square btn-primary float-right">Add Product</button>
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
    import AppStorage from "../../Helpers/AppStorage";
    export default {
        name: 'Login',
        data(){
            return{
                form:{
                    name : "",
                    product_code : "",
                    buying_price : "",
                    selling_price: "",
                    category_id: "",
                    supplier_id: "",
                    added_by: "",
                    quantity: "",
                    buying_date: "",
                },
                errors: {},
                categories:[],
                suppliers:[],
            }
        },
        mounted() {
            if (!User.loggedIn()) { 	//check login or not
                this.$router.push({name: 'login'});
            }
            this.categoryList();
            this.supplier_List();
        },
        methods: {
            storeProduct(){
                axios.post('/api/product/store', this.form)
                .then(res => {
                    Toast.fire({
                        icon: 'success',
                        title: 'New product added successfully!'
                    })
                    this.$router.push({ name: 'product.index' })
                })
                .catch(error => {
                    this.errors =  error.response.data.errors;
                })
            },

            categoryList(){
                axios.get('/api/category/list')
                    .then(res => {
                        this.categories = res.data;
                    })
            },

            supplier_List(){
                axios.get('/api/supplier/list')
                    .then(res => {
                        this.suppliers = res.data;
                    })
            }
        }
    }
</script>
