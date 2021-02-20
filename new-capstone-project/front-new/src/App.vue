<template>
  <div id="app">
    <!-- <img src="src/assets/img/0.png" alt=""> -->
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

<style scoped>
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
