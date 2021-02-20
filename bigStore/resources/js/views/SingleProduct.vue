<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <img :src="product.image" :alt="product.name">
                <h3 class="title" v-html="product.name"></h3>
                <p class="text-muted">{{product.description}}</p>
                <h4>
                  <span class="small-text text-muted float-left">$ {{product.price}}</span>
                  <span class="small-text float-right">Available Quantity : {{product.units}}</span>
                </h4>
                <br>
                <hr>
                <router-link :to="{path:'/checkout?pid='+product.id}" class="col-md-4 btn btn-primary float-right">Buy Now</router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            product:[]//Home.vue에서 한 거처럼 페이지에 정보를 표시하는데 사용
        }
    },
    //beforeMount메서드를 정의하고 제품 정보를 가져 옴
    //마운트 된 후 : 데이터를 가져오면 구성 요소가 업데이트되기 전에 오류가 발생
    beforeMount(){//렌더링 전 호출, 구성요소를 렌더링하는데 필요한 데이터를 가져옴
        let url = '/api/products/'+this.$route.params.id
        axios.get(url).then(response => this.product = response.data)
    }
}
</script>

<style>
    .small-text{
        font-size:18px;
    }
    .title{
        font-size:36px;
    }
</style>
