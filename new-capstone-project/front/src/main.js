import Vue from 'vue'
import App from './App.vue'
import Router from './routes.js'

import VeeValidate from 'vee-validate'
Vue.use(VeeValidate)

import Auth from './packages/auth/Auth.js'
Vue.use(Auth)

import VueResource from 'vue-resource'
Vue.use(VueResource)

import Vuetify from 'vuetify'
Vue.use(Vuetify)

// import axios from 'axios'
// Vue.use(axios)

//Vue.prototype.$http = axios

Vue.http.options.root = 'http://localhost:8000'
//Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken
//전역으로 header한테 token을 전달
Vue.http.headers.common['Authorization']= 'Bearer ' + Vue.auth.getToken()

//404, 500오류 찾는 거를 전역으로 정의
Vue.http.interceptors.push((request, next) => {
    next(response =>{
      if(response.status == 404)
        swal(response.status.toString(), response.body.error, "error")//response.body.error : return response()->json(['error'=>'Resource not found!'], 404);
      else if(response.status == 500)
        swal(response.status.toString(), "We are experiencing a problem in our servers!", "error")
    })
})

Router.beforeEach(
  (to, from, next) => {
    //로그인한 경우
    if(to.matched.some(record => record.meta.forVisitors)){// (routes.js) '/login', '/register' : meta{ forVistiors:ture }
      if(Vue.auth.isAuthenticated()){ //(Auth.js) = this.$auth.isAuthenticated()
        next({
          path:'/feed'
        })
      } else next()
    } 
    //로그인 안 된 경우
    //'/feed'에 들어갈려고 할 때 로그인이 안 되있으면  '/login' 경로로 바로 전환
    else  if(to.matched.some(record => record.meta.forAuth)){// '/feed' : meta{ forAuth:ture }
      if(! Vue.auth.isAuthenticated()){ // = this.$auth.isAuthenticated() : Auth.js에 있음
        next({
          path:'/login'
        })
      } else next()
    } 
    
    else next()
  }
)

// Vue.use(Vuetify, {
//   theme: {
//     pink: '#3f51b5'
//   }
// });

new Vue({
  el: '#app',
  render: h => h(App),
  router: Router,
})
