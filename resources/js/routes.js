let Login = require('./components/auth/Login').default;
let Register = require('./components/auth/Register').default;
let Home = require('./components/Home').default;
export const routes = [
    { path: '/', component: Login, name:'login'},
    { path: '/register', component: Register, name:'register'},
    { path: '/home', component: Home, name:'home'}
]
