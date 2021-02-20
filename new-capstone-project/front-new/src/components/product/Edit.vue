<template>
<!-- 상품 등록 -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="form-group">
                        <label for="">Name:</label>
                        <input type="text" class="form-control" v-model="product.name">
                    </div>

                     <div class="form-group">
                        <label for="">Price:</label>
                        <input type="number" class="form-control" v-model="product.price">
                    </div>

                     <div class="form-group">
                        <label for="">Description:</label>
                        <textarea class="form-control"  v-model="product.description"></textarea>
                    </div>
                    <!-- v-show : 엘리먼트를 조건부로 표시하기 위한 옵션, 항상 렌더링 되고 DOM에 남아있음-->
                    <button class="btn btn-success pull-right" 
                        @click="update"
                        v-show="product.name && product.price && product.description">
                        Update
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
            product:{}
        }
    },
    methods:{
        getProduct(){
            this.axios.get('api/products/'+this.$route.params.product)
                .then(response => {
                    this.product = response.data
                })
                //페이지(상품id)가 없는데 접속할려고 할 경우(404에러)
                // .catch(response => {
                //     swal(response.status.toString(), response.body.error, "error")//response.body.error : return response()->json(['error'=>'Resource not found!'], 404);
                // })
        },
        update(){
            this.axios.put('api/products/' + this.$route.params.product, this.product) 
                .then(response =>{
                    swal("Updated!", "Your product has been updated!", "success")
                    this.$router.push('/feed')
                })
        }
    }
}
</script>

<style>

</style>
