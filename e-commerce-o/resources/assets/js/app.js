import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import Home from './views/Home'
import Login from './views/Login'
import Register from './views/Register'
import SingleProduct from './views/SingleProduct'
import Checkout from './views/Checkout'
import Confirmation from './views/Confirmation'
import UserBoard from './views/UserBoard'
import Admin from './views/Admin'

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
            path: '/confirmation',//
            name: 'confirmation',
            component: Confirmation
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