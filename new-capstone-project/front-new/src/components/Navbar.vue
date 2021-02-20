<template>
    <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
             <router-link tag="li" to="/login" v-if="!isAuth">
                <a href="">Login</a>
             </router-link>

             <router-link tag="li" to="/register" v-if="!isAuth">
                <a href="">Register</a>
             </router-link>

              <router-link tag="li" to="/feed" v-if="isAuth">
                <a href="">Feed</a>
             </router-link>

             <router-link tag="li" to="/products/create" v-if="isAuth">
                <a href="">Create</a>
             </router-link>

             <router-link tag="li" to="/logout" v-if="isAuth">
                <a href="">Logout</a>
             </router-link>

             <router-link tag="li" to="/mypage" v-if="isAuth">
                <a href="">My-Page</a>
             </router-link>

              <router-link tag="li" to="/order" v-if="isAuth">
                <a href="">OrderList</a>
             </router-link>

              <router-link tag="li" to="/wishlist" v-if="isAuth">
                <a href="">WishList</a>
             </router-link>

             <router-link tag="li" to="/community" v-if="isAuth">
                <a href="">Community</a>
             </router-link>
          </ul>
        </nav>
        <h3 class="text-muted">Project name</h3>
      </div>
</template>

<script>
export default {
    data(){
        return {
            isAuth: null
        }
    },
    created() {
        //Auth.js에 정의됨, main.js에서 로그인 유무 구분
        this.isAuth = this.$auth.isAuthenticated()
        //methods: setAuthenticatedUser() => 로그인 유무를 확인 후 사용자의 모든 정보를 저장
        this.setAuthenticatedUser()
    },
    methods:{
        setAuthenticatedUser(){
            this.axios.get('api/user') //auth:api
                .then(response => {
                    //Auth::all() : 로그인 사용자의 모든 정보를 저장(인증 확장)
                    this.$auth.setAuthenticatedUser(response.data)
                    console.log(this.$auth.getAuthenticatedUser())
                })
        }
    }
}
</script>

<style scoped>
    a{
        margin: 10px;
    }

    .router-link-active{
        background-color: blue;
        color:white;
    }
</style>
