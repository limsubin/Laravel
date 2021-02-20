<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" @click="handleSubmit">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                email : "",
                password : ""
            }
        },
        methods : {
        //양식을 제출할 때 API를 사용하여 인증을 시도
        //사용자가 다른 페이지에서 로그인 페이지로 전송되었는지 확인한 다음 해당 페이지로 사용자를 보냄
        //사용자가 직접 로그인하면 사용자 유형을 확인하고 사용자를 적절히 리디렉션합니다.
            handleSubmit(e){
                e.preventDefault()
                //인증에 성공하면 : 액세스 토큰, 사용자 데이터 저장
                //localStorage앱 전반에 액세스 할 수 있도록한다
                
                if (this.password.length > 0) {

                    // this.$http.post("http://localhost:8000/oauth/token", data)
                    // .then(response => {
                    //     console.log(response)
                    // })

                    this.$http.post('http://localhost:8000/api/login', {
                        email: this.email,
                        password: this.password
                      })
                      .then(response => {
                        console.log(response)
                        let is_admin = response.data.user.is_admin
                        //let token = response.data.token
                        //액세스 토큰, 사용자 데이터 저장, localStorage앱 전반에 액세스 할 수 있도록한다
                        localStorage.setItem('user',JSON.stringify(response.data.user))
                        localStorage.setItem('token',response.data.token)

                        //this.$auth.setToken(response.body.access_token, response.body.expires_in + Date.now())
                        if (localStorage.getItem('token') != null){
                            this.$emit('loggedIn')
                            if(this.$route.params.nextUrl != null){
                                this.$router.push(this.$route.params.nextUrl)
                                // const headers = {
                                //     'Accept': 'application/json',
                                //     'Authorization':'Bearer'+localStorage.setItem('jwt')
                                // }
                                // return headers
                            }
                            else {
                                if(is_admin== 1){
                                    this.$router.push('admin')
                                }
                                else {
                                    this.$router.push('dashboard')
                                }
                            }
                        }
                      });
                }
            }
        }
    }
</script>

