<template>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <input v-model="email" class="form-control" type="email" placeholder="Email"/>
                    </div>
                    <div class="form-group">
                        <input v-model="password" class="form-control" type="password" placeholder="Password"/>
                    </div>
                    <button @click="login" class="btn btn-success pull-right">Login</button>
                </div>
            </div>
        </div>

        <pre>
            {{ $data }}
        </pre>
    </div>
</template>

<script>
export default {
    data(){
        return {
            email:'',
            password:''
        }
    },
    methods:{
        login(){
            var data = {
                client_id:2,
                client_secret: 'ihYs3l6SsvWklbHupezVpNkrwKQzxQELPqThAUS9',
                grant_type:'password',
                username: this.email,
                password: this.password
            };

            this.$http.post("oauth/token", data)
             .then(response =>{
                 //로그인하면서 토큰 지정함(로그인한 후)
                 this.$auth.setToken(response.body.access_token, response.body.expires_in + Date.now())
                 //'/feed'라는 경로로 이동
                 this.$router.push("/feed")
             })
               /* .then(function(response){
                    console.log(response)
                })*/
        }
    }
}
</script>

<style>

</style>
