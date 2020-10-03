let Login = require('./components/auth/Login').default;
let Logout = require('./components/auth/Logout').default;
let Register = require('./components/auth/Register').default;
let Home = require('./components/Home').default;
let CreateEmployee = require('./components/employee/create').default;
let Index = require('./components/employee/index').default;
let CreateCustomer = require('./components/customer/create').default;
let Customer = require('./components/customer/index').default;
let CreateSupplier = require('./components/supplier/create').default;
let Supplier = require('./components/supplier/index').default;
let Category = require('./components/category/index').default;
let CreateProduct = require('./components/product/Create').default;
let Product = require('./components/product/Index').default;
let Pos = require('./components/pos/Index').default;

export const routes = [
    { path: '/', component: Login, name:'login'},
    { path: '/register', component: Register, name:'register'},
    { path: '/logout', component: Logout, name:'logout'},
    { path: '/home', component: Home, name:'home'},
    //Employee
    { path: '/employee/add', component: CreateEmployee , name:'employee.create'},
    { path: '/employee/list', component: Index, name: 'employee.index'},

    //Customer
    { path: '/customer/add', component: CreateCustomer , name:'customer.create'},
    { path: '/customer/list', component: Customer, name: 'customer.index'},

    //Supplier
    { path: '/supplier/add', component: CreateSupplier , name:'supplier.create'},
    { path: '/supplier/list', component: Supplier, name: 'supplier.index'},

    //category
    { path: '/category', component: Category, name: 'category.index'},

    //Product
    { path: '/product', component: Product, name: 'product.index'},
    { path: '/product/add', component: CreateProduct, name: 'product.add'},

    //POS
    { path: '/point-of-sale', component: Pos, name: 'pos.index'},
]
