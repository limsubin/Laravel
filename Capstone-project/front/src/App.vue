<template>
  <div class="container" id="app">
    <router-view></router-view>
  </div>
</template>

<script>
import Login from './components/Login.vue'

export default {
  components:{
    'login':Login
  }
}
</script>

<style>

</style>
