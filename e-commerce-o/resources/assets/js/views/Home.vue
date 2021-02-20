<template>
    <div>
        <div class="container">
            <div class="row">
                <!-- poducts 각 제품에 대한 표시(image, name, id, price, units) -->
                <!-- proudcts:원본데이터 배열, (product,index):반복되는 데이터배열 -->
                <!-- v-for :블록 안에는 부모 범위 속성에 대한 모든 권한이 있음, 현재 항목의 인덱스에 대한 두번째 전달인자 옵션을 제공 -->
                <div class="col product-box" v-for="(product,index) in products" @key="index" :key="index">
                    <router-link :to="{ path: '/products/'+product.id}">
                        <img :src="product.image" :alt="product.name" width="200">
                    <!-- v-html : 원시HTML을 렌디링하므로 제품 이름에 특수문자를 쉽게 사용가능 -->
                    <h5>
                        <span v-html="product.name"></span><br>
                        <span class="small-text text-muted float-right"> {{product.price}}원</span>
                    </h5>
                    <br>
                    <button class="col-md-4 btn btn-sm float-left">Buy Now</button>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){//모든 변수 보유
            return {
                products : []
            }
        },
        //컴포넌트가 로드된 후에 호출되는 메소드 정의
        mounted(){
            //API에서 제품을 로드한 다음 products의 API데이터로 템플릿을 업데이트 할수 있도록 변수로 설정
            axios.get("api/products/")
            .then(response => {
                this.products = response.data
            })
            .catch(error => {
                console.error(error);
            })       
        }
    }
</script>
<style scoped>
    .small-text {
        font-size: 20px;
    }
    .product-box {
        padding: 5px 10px;
        margin-bottom: 30px;
    }
    .hero-section {
        height: 30vh;
        background: #ababab;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }
    .title {
        font-size: 60px;
        color: #ffffff;
    }
    h5{
       color:black;
    }
    router-link{
        text-decoration: none;
    }
    button{
        border-radius: 40px!important;
        background: rgb(237,153,117);
        background: linear-gradient(30deg, rgba(237,153,117,1) 0%, rgba(255,108,137,1) 50%, rgba(234,119,142,1) 83%, rgba(213,119,147,1) 100%);
        color:white;
    }
</style>