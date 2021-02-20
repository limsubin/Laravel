import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'

Vue.use(VueResource)
Vue.use(VueRouter)
Vue.http.options.root = 'http://localhost:8000'

// let config ={
//     headers:{
//         "access-token":response.data.token
//     }
// }
//Vue.http.options.headers={};
//Vue.http.options.headers.Authorization='token ' + (localStorage['jwt'] || '')
//Vue.http.headers.common['Authorization'] = 'Basic'+localStorage.getItem('jwt');
//Vue.http.headers.common['Authorization'] = 'Basic YXBpOnBhc3N3b3Jk'
// Vue.http.interceptors.push((request, next) => {
//     request.headers.set('Authorization', 'Bearer ' + Vue.auth.getAccessToken())
//     next()
//   })
// Vue.http.options.credentials = true;
import App from './assets/js/views/App'
import Home from './assets/js/views/Home'
import Login from './assets/js/views/Login'
import Register from './assets/js/views/Register'
import SingleProduct from './assets/js/views/SingleProduct'
import Checkout from './assets/js/views/Checkout'
import Confirmation from './assets/js/views/Confirmation'
import UserBoard from './assets/js/views/UserBoard'
import Admin from './assets/js/views/Admin'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',//
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/products/:id',//
            name: 'single-products',
            component: SingleProduct
        },
        {
            path: '/confirmation',
            name: 'confirmation',
            component: Confirmation,
            // headers:{
            //     "access-token": 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM1MDdiM2IzNDUyMzczYzc1YTQ3ZjdkMDMxZGE1MDBjM2U5NmFkZDlhNWZkN2NkN2I0YWZhOWUwNGFiNzliYjAwNGE0MWFlYTZkMmE3NGRkIn0.eyJhdWQiOiIzIiwianRpIjoiYzUwN2IzYjM0NTIzNzNjNzVhNDdmN2QwMzFkYTUwMGMzZTk2YWRkOWE1ZmQ3Y2Q3YjRhZmE5ZTA0YWI3OWJiMDA0YTQxYWVhNmQyYTc0ZGQiLCJpYXQiOjE1NTIxOTMyMjYsIm5iZiI6MTU1MjE5MzIyNiwiZXhwIjoxNTgzODE1NjI2LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.fgxBHrRvKXiUWLs2Hb5vm8JLgdQzGORcfQum78vZktLORj3gxFfn0r2eF-2S5tifLNi3bhYCIQhkjPblalu2kB3ZvABsBKXda7QSpkA25e5-N0w24sXNLGVfDdEUJyvwyv5KCQx7FwWWVGJTkJHmNiqFzJlamxyxNca0xVSGNdFgY7zZ8d6vXoKRur3k_GGzSacA1aRVSkedKh2PM13acI5U_di6Y0-5H6P4eEO7MqNxE2O51Ns2SaGtXOxjkC1Gl3KTdNkHy4CX4znG_zFJIFK4t2EuRa0p6SOpU2ZTfW4LCLcB2H4u0XWSUoqgMO3Syo2KjKbzGDkhgqhkx6OIeefywV-zqV_an_3X6-wM0dIN2RnP07N6Ruooy-o6D-Kb4lAHpvEijLxxO_K4HWl-kZ0KbFbcBab34VhlFF5tNVe7kdZRKaGBGPIVRX672d15wKKcY9M0BkgFA9NeCvepYs1NUrpfE3A4r5V9MCtzQt9l8avaCsEpyUXjx21C2kWFOEu1wROSX1JU2VjcP6VMOww6As2nUGfMnc-eg1R5lVE-dQuerDHzzuV4SCkc2u2YqSpQjWt2G64lx3kltIN68sxwi4rRYaCJZh7W4JcS4FZSyUbkh8NcnmMJOFR3GlkNsNcOyrqxxSVHQdBJzkA0ym1c_BNRIMai06msIx4-TGw'
            // }
        },
        {
            path: '/checkout',//
            name: 'checkout',
            component: Checkout,
            props: (route) => ({pid : route.query.pid})
        },
        {
            path: '/dashboard',
            name: 'userboard',
            component: UserBoard,
            meta: { //확인할 변수가 포함된 경로 정의
                requiresAuth: true,//경로 인증 필요 여부
                is_user : true//관리자, 일반 사용자에게만 제한되는지 확인
            }
        },
        {
            path: '/admin/:page',
            name: 'admin-pages',
            component: Admin,
            meta: { 
                requiresAuth: true,
                is_admin : true
            }
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            meta: { 
                requiresAuth: true,
                is_admin : true
            }
        },
    ],
})

//액세스하기 전에 인증이 필요한 경로를 확인하는 데 사용
//해당 경로의 경우 사용자가 인증되었는지 확인
//각 사용자를 어떤 액세스 수준에 따라 올바른 위치로 리디렉션
router.beforeEach((to, from, next) => {
  if(to.matched.some(record => record.meta.requiresAuth)) {
    if (localStorage.getItem('jwt') == null) {
      //사용자가 아닌 경우 : 로그인 페이지로 전송
      next({
        path: '/login',
        params: { nextUrl: to.fullPath }
      })
    //사용자가 인증되면 : 경로가 관리자 또는 일반 사용자로 제한되는지 확인   
    } else {
      let user = JSON.parse(localStorage.getItem('user'))
      if(to.matched.some(record => record.meta.is_admin)) {
        if(user.is_admin == 1){
            next()
        }
        else{
            next({ name: 'userboard'})
        }
      }
      else if(to.matched.some(record => record.meta.is_user)) {
        if(user.is_admin == 0){
            next()
        }
        else{
            next({ name: 'admin'})
        }
      }
      next()
    }
  } else {
    next() 
  }
})

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});