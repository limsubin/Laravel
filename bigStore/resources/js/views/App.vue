<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light narbar-laravel">
            <div class="container">
                <router-link :to="{name:'home'}" class="navbar-brand">Big Store</router-link>
                <button class="narbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>
                    <!-- Right Side of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <router-link :to="{name:'login'}" class="nav-link" v-if="!isLoggedIn">Login</router-link>
                        <router-link :to="{name:'register'}" class="nav-link" v-if="!isLoggedIn">Register</router-link>
                        <span v-if="isLoggedIn">
                            <router-link :to="{name:'login'}" class="nav-link" v-if="user_type==0">Hi, {{name}}</router-link>
                            <router-link :to="{name:'admin'}" class="nav-link" v-if="user_type==1">Hi, {{name}}</router-link>
                        </span>
                        <li class="nav-link" v-if="isLoggedIn" @click="logout">Logout</li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- <router-link>로드 되는 곳 -->
        <main class="py-4">
            <router-view @loggedIn="change"></router-view>
        </main>
    </div>
</template>

<script>
export default {
    data(){
        return{
            name:null,
            user_type:0,
            //bigStore.jwt
            isLoggedIn:localStorage.getItem('bigStore.jwt') != null
        }
    },
    mounted(){
        this.setDefaults()
    },
    methods:{
        //사용자가 로그인할 때 사용자의 이름과 로그인한 사용자의 유형 설정
        setDefaults(){
            if(this.isLoggedIn){
                let user = JSON.parse(localStorage.getItem('bigStore.user'))
                this.name = user.name
                this.user_type = user.is_admin
            }
        },
        //호출 할 때마다 현재 로그인 상태를 확인, setDefaults메소드 호출
        change(){
            this.isLoggedIn = localStorage.getItem('bigStore.jwt') != null
            this.setDefaults()
        },
        //사용자를 응용 프로그램에서 로그아웃, 사용자를 홈페이지로 라우트
        logout(){
            localStorage.removeItem('bigStore.jwt')
            localStorage.removeItem('bigStore.user')
            this.change()
            this.$router.push('/')//사용자를 홈페이지로 라우트
        }
    }
}
</script>

<style>

</style>
