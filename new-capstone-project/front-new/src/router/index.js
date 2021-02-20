import Vue from 'vue'
import Router from 'vue-router'

//import HelloWorld from '@/components/HelloWorld'

import Login from '@/components/authentication/Login.vue'
import Register from '@/components/authentication/Register.vue'
import Feed from '@/components/Feed.vue'
import Create from '@/components/product/Create.vue'
import Edit from '@/components/product/Edit.vue'
import View from '@/components/product/View.vue'
import Emotion from '@/components/mypage/Emotion.vue'
import Order from '@/components/mypage/Order.vue' //나중에 Order.vue로 변경
import Wishlist from '@/components/mypage/WishList.vue'
import Community from '@/components/mypage/Community.vue'

Vue.use(Router)

export default new Router({
  routes: [
    //login,register
    {
      path:'/login',
      component:Login,
      meta:{
          forVisitors: true
      }
  },
  {
      path:'/register',
      component:Register,
      meta:{
          forVisitors: true
      }
  },
  //상품목록
  {
      path: '/feed',
      component: Feed,
      meta:{
          forAuth: true
      }
  },
  //마이페이지
  {
      path: '/Mypage',
      component: Emotion,
      meta:{
          forAuth: true
      }
  },
  //주문리스트
  {
      path: '/order',
      component: Order,
      meta:{
          forAuth: true
      }
  },
  //장바구니
  {
      path: '/wishlist',
      component: Wishlist,
      meta:{
          forAuth: true
      }
  },
  //커뮤니티 작성 페이지
  {
    path: '/community',
    component: Community,
    meta:{
        forAuth: true
    }
   },
  {
      path: '/Mypage',
      component: Emotion,
      meta:{
          forAuth: true
      }
  },
  {
      path: '/products/create',
      component: Create,
      meta:{
          forAuth: true
      }
  },
  {
      path: '/products/:product/edit',
      component: Edit,
      meta:{
          forAuth: true
      }
  },
  {
      path: '/products/:product/view',
      component: View,
      meta:{
          forAuth: true
      }
  }
  ],
  linkActiveClass: 'active',
  mode:'history'
})
