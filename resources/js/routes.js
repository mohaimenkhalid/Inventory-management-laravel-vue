let Login = require('./components/auth/Login').default;
let Logout = require('./components/auth/Logout').default;
let Register = require('./components/auth/Register').default;
let Home = require('./components/Home').default;
export const routes = [
    { path: '/', component: Login, name:'login'},
    { path: '/register', component: Register, name:'register'},
    { path: '/logout', component: Logout, name:'logout'},
    { path: '/home', component: Home, name:'home'}
]
