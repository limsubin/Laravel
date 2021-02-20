<template>
<!-- 상품 등록 -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <div>view</div>
                        <hr>
                        <!-- <img :src="'http://localhost:8000/'+product.image" :alt="product.name" height="100"><br><br> -->
                        <label for="">Name:</label>
                        <div>{{product.name}}</div>
                    </div>

                     <div class="form-group">
                        <label for="">Price:</label>
                        <div>{{product.price}}</div>
                    </div>

                     <div class="form-group">
                        <label for="">Description:</label>
                        <div>{{product.description}}</div>
                    </div>
                    <!-- v-show : 엘리먼트를 조건부로 표시하기 위한 옵션, 항상 렌더링 되고 DOM에 남아있음-->
                    <button class="btn btn-success pull-right" 
                        @click="placeOrder">
                        Buy
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import swal from 'sweetalert'

export default {
    created(){
        this.getProduct()
    },

    data(){
        return{
            quantity:1,
            product:{}
        }
    },
    methods:{
        getProduct(){
            this.$http.get('api/products/'+this.$route.params.product)
                .then(response => {
                    this.product = response.body
                })
        },
        placeOrder(){
            this.$http.post('api/orders/', this.product, {
                    quantity: this.quantity,//수량
                    product : this.product.id,
            }) 
                .then(response =>{
                   console.log(response.body)
                    swal("구매완료!", "구매해주셔서 고맙습니다", "success")
                    this.$router.push('/order')//feed
                })

        }
    }
}
</script>

<style>

</style>
