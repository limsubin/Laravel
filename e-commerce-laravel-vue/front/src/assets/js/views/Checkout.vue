<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="order-box">
                    <img :src="product.image" :alt="product.name">
                    <h2 class="title" v-html="product.name"></h2>
                    <p class="small-text text-muted float-left">$ {{product.price}}</p>
                    <p class="small-text text-muted float-right">Available Units: {{product.units}}</p>
                    <br>
                    <hr>
                    <label class="row"><span class="col-md-2 float-left">Quantity: </span><input type="number" name="units" min="1" :max="product.units" class="col-md-2 float-left" v-model="quantity" @change="checkUnits"></label>
                </div>
                <br>
                <div>
                    <div v-if="!isLoggedIn">
                        <h2>You need to login to continue</h2>
                        <button class="col-md-4 btn btn-primary float-left" @click="login">Login</button>
                        <button class="col-md-4 btn btn-danger float-right" @click="register">Create an account</button>
                    </div>
                    <div v-if="isLoggedIn">
                        <div class="row">
                            <label for="address" class="col-md-3 col-form-label">Delivery Address</label>

                            <div class="col-md-9">
                                <input id="address" type="text" class="form-control" v-model="address" required>
                            </div>
                        </div>
                        <br>
                        <button class="col-md-4 btn btn-sm btn-success float-right" v-if="isLoggedIn" @click="placeOrder">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props : ['pid'],
        data(){
            return {
                address : "",
                quantity : 1,//수량
                isLoggedIn : null,//v-if 로그인값 인증
                product : []
            }
        },
        //인증 상태를 확인하는 방법
        mounted(){
            this.isLoggedIn = localStorage.getItem('token') != null
            //alert("jwt: "+localStorage.getItem('jwt'))
        },
        //제품 정보를 가져오는 방법(상세페이지)
        beforeMount(){
            this.$http.get('api/products/'+this.pid)
                .then(response => {
                    this.product = response.data
                })
                .catch(error => {
                    console.error(error);
                })       
            //로그인한 경우
            if(localStorage.getItem('token') != null){
                this.user = JSON.parse(localStorage.getItem('user'))
                //this.user = JSON.parse(localStorage.getItem('user'))
                // http.interceptors.request.use(
                //     async (config) => {
                //         const token = localStorage.getItem('jwt'); // slightly longer running function than example above
                //         if (token) config.headers.Authorization = 'Bearer'+token;
                //         return config;
                //     },
                //     (error) => {
                //         return Promise.reject(error);
                //     }
                // );
                //this.http._defaultOptions.headers.set('Authorization', localStorage.getItem('jwt'));
                this.$http.headers.common['Content-Type'] = 'application/json'
                this.$http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token')
                alert("token:"+localStorage.getItem('token'))
            }
        },
        methods : {
            login(){
                this.$router.push({ name: 'login', params: { nextUrl: this.$route.fullPath }})
            },
            register(){
                this.$router.push({ name: 'register', params: { nextUrl: this.$route.fullPath }})
            },
            //정의한 단위 검사
            placeOrder(e) {
                  var data = {
                        client_id: 4,
                        client_secret:'P4G78oRkCWbOd9ALn3xcdjVQeI5UpG2f3tWUTnkc',
                        grant_type:'password',
                        username: this.email,
                        password: this.password,
                        //token:this.data.token,
                        //content:this.$http.headers.common['Content-Type'] = 'application/json',
                        //Authorization:this.$http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
                    }
                

                //e.preventDefault()
                this.$http.post('api/orders', data,{
                    address : this.address,
                    quantity: this.quantity,
                    product : this.product.id,
                    // headers:{
                    //     //'Authorization': 'Basic YWRtaW46YWRtaW4=',
                    //     'access-token': localStorage.getItem('jwt')
                    // }
                })
                .then(response => {
                    // let config ={
                    //     headers:{
                    //         "access-token":response.data.token
                    //     }
                    // }
                    console.log("response.data.token: "+response.data.token)
                    //alert("response")
                    //this.$http.headers.common['Content-Type'] = 'application/json'
                    //this.$http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
                    this.$router.push('/confirmation')
                })
                  alert("address : "+this.address
                    +",quantity:"+ this.quantity+
                    ",product :"+ this.product.id)        
            },
            //사용자의 주문
            checkUnits(e){
                if (this.quantity > this.product.units)
                {
                    this.quantity = this.product.units
                }
            }
        }
    }
</script>
<style scoped>
    .small-text {
        font-size: 18px;
    }
    .order-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
    .title {
        font-size: 36px;
    }
</style>