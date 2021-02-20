// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)

import Auth from './packages/auth/Auth.js'
Vue.use(Auth)

import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(BootstrapVue)

// import Vuetify from 'vuetify'
// import colors from 'vuetify/es5/util/colors'
// Vue.use(Vuetify)

Vue.axios.defaults.baseURL = 'http://localhost:8000'
Vue.axios.defaults.headers['Authorization'] = 'Bearer ' + Vue.auth.getToken()

Vue.config.productionTip = false

Vue.axios.defaults.headers.common = {
  'X-Requested-With': 'XMLHttpRequest',
  'X-CSRF-TOKEN': window.csrf_token
};

router.beforeEach(
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
//     primary: colors.red.darken1, // #E53935
//     secondary: colors.red.lighten4, // #FFCDD2
//     accent: colors.indigo.base // #3F51B5
//   }
// })

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
