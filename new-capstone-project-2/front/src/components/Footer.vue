<template>
<div>
    <div id="footBack" style="padding: 3%; margin-top:3%;">
        <div>
            <div class="container text-center">
                <img src="/src/img/logo1-8.png" width="150" class="d-inline-block align-top" alt="">
            </div>
            <div class="container text-center" style="padding-top: 0.5%;">
                Developed Team Diffuser
            </div>
            <div class="container text-center" style="padding-top: 0.5%;">
                Developers 서보민 금상원 신현빈 문은빈 임수빈
            </div>
        </div>
    </div>
</div>
</template>

<script>
/* export default {
    data () {
      return {
        isAuth: null
      }
    },

    created () {
      this.isAuth = this.$auth.isAuthenticated()

      this.setAuthenticatedUser()
    },

    methods: {
      setAuthenticatedUser () {
        this.$http.get('api/user')
        .then(response => {
          this.$auth.setAuthenticatedUser(response.body)

          console.log(this.$auth.getAuthenticatedUser())
        })
      }
    }
} */
</script>

<style>
 #footBack {
    background: rgb(237,153,117);
    background: linear-gradient(145deg, rgba(237,153,117,1) 0%, rgba(234,119,142,1) 74%, rgba(234,119,142,1) 83%, rgba(213,119,147,1) 100%);
    color: white;
 }
</style>