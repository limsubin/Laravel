<template>
  <div class="container" id="app">
    <navbar></navbar>
    <router-view></router-view>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue'

export default {
      components:{
        'navbar':Navbar
      }
}
</script>

<style>
 body{
   padding-top: 20px;
   padding-bottom: 20px;
 }

 .header,
 .marketing,
 .footer{
   padding-right: 15px;
   padding-left: 15px;
 }

 .header{
   margin-bottom:30px;
 }
</style>
