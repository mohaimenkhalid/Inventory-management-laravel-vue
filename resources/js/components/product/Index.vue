<template>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5>Product List</h5>
            </div>
            <div class="card-block table-border-style">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Buying Price</th>
                            <th>Selling Price</th>
                            <th>Category</th>
                            <th>Supplier</th>
                            <th>Buying Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td colspan="8" class="text-center" v-if="loading">
                                <img src="/images/spinner.gif">
                            </td>
                        </tr>
                        <tr v-for="(product, index) in products">
                            <th scope="row">{{ index+1 }}</th>
                            <td>{{ product.name }}</td>
                            <td>{{ product.buying_price }}</td>
                            <td>{{ product.selling_price }}</td>
                            <td>{{ product.category.name }}</td>
                            <td>{{ product.supplier.name }}</td>
                            <td>{{ product.buying_date }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" @click="editProduct(product.id)">Edit</button>
                                <button class="btn btn-danger btn-sm" @click="removeProduct(product.id)">Delete</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Update Product Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Modal Body -->
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
                                    <button type="button" @click="updateProduct"  class="btn btn-square btn-primary float-right">Update Product</button>
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
                products: [],
                loading: true,
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
                product_ids : 0
            }
        },
        mounted(){
            if (!User.loggedIn()) {     //check login or not
                this.$router.push({ name: 'login' });
            }
            this.allProducts();
            this.categoryList();
            this.supplier_List();
        },
        methods: {
            allProducts(){
                axios.get('/api/product/list')
                .then(res => {
                    this.loading = false;
                    this.products = res.data;
                })
                .catch()
            },

            removeProduct(id){
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
                        axios.delete('/api/product/delete/'+id)
                        .then(res => {
                            this.products = this.products.filter(product => {
                                return product.id !== id;
                            })
                            Swal.fire(
                                'Deleted!',
                                'Your Product has been deleted.',
                                'success'
                            )
                        })
                        .catch(()=>{
                            this.router.push({ path: '/employee'});
                        })
                    }
                });
            },
            editProduct(product_id){
                this.product_ids = product_id;
                axios.get('/api/product/edit/'+product_id)
                .then(res => {
                    this.form = res.data;
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
            },
            updateProduct(){
                axios.post('/api/product/update/'+this.product_ids, this.form)
                .then(res => {
                    this.allProducts();
                    $('#exampleModal').modal('hide')
                    $('.modal-backdrop').remove();
                    if (res.data.success){
                        Toast.fire({
                            icon: 'success',
                            title: 'Product Data Updated Successfully!'
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
