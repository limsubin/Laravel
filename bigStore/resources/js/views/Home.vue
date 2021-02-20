<template>
    <div>
        <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class="title">Welcome to the binStore</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <!-- poducts 각 제품에 대한 표시(image, name, id, price, units) -->
                        <div class="col-md-4 product-box" v-for="(product, index) in products" :key="index" v-on:key="index">
                            <router-link :to="{path:'/products/'+product.id}">
                                <img :src="product.image" :alt="product.name">
                                <h5>
                                    <!-- v-html : 원시HTML을 렌디링하므로 제품 이름에 특수문자를 쉽게 사용가능 -->
                                    <span v-html="product.name"></span>
                                    <span class="small-text text-muted float-right">$ {{product.price}}</span>
                                </h5>
                                <button class="col-md-4 btn btn-sm btn-primary float-right">Buy Now</button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){//모든 변수 보유
        return{
            products: []
        }
    },
    //컴포넌트가 로드된 후에 호출되는 메소드 정의
    mounted(){
        //API에서 제품을 로드한 다음 products의 API데이터로 템플릿을 업데이트 할수 있도록 변수로 설정
        axios.get("api/products/").then(response=>this.products = response.data)
    }
}
</script>

<style scoped>
    .small-text{
        font-size:14px;
    }
    .product-box{
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
    .hero-section{
        height:30vh;
        background:#ababab;
        align-items:center;
        margin-bottom:20px;
        margin-top:-20px;
    }
    .title{
        font-size: 60px;
        color:#ffffff;
    }
</style>
