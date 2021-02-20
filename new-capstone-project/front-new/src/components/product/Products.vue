<template>
    <div class="row">
        <span class="badge badge-pill badge-light" v-text="Object.keys(cartItems).length"></span>
        <br>
        {{cartItems}}
        <my-product 
        v-for="(product, index) in products"
        @delete-product="deleteProduct(product)"
        @addTo-Cart = "addCart(index)" 
        :product="product"
        :authenticatedUser="authenticatedUser" :key="index">
        </my-product>
        
    </div>
</template>

<script>
import Product from './Product.vue'
import swal from 'sweetalert'
//:product="product" : v-for로 인해 가지고 온 상품 정보를 바인드
    export default{
        data(){
            return {
                products:[],
                cartItems:[],
                count:0
            }
        },
        //상품 하나하나에 로그인한 사용자의 데이터 정보를 "props"해서 데이터 전달함
        computed:{
            authenticatedUser(){
                return this.$auth.getAuthenticatedUser()
            }
        },
        components:{
            'my-product':Product
        },
        created(){
            this.axios.get('api/products')
                .then(response => {
                    this.products = response.data
                })
        },
        methods:{
            deleteProduct(product){
                console.log(product)
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this product",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            this.axios.delete('api/products/' + product.id)
                                .then(response => {
                                    //indexOf : 문자열에서 원하는 문자열을 검색하여 찾거나 아니면 배열에서 원하는 특정 배열값의 존재여부 등을 확인
                                    let index = this.products.indexOf(product)
                                    //console.log(response)
                                    //spice메소드 : 지정된 인덱스에서 시작하여 아이템을 잘라내고 제거하여 반환합니다.
                                    this.products.splice(index, 1)
                                    swal("Poof! Your product has been deleted!", {
                                    icon: "success",
                                    });
                                })
                            
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    });
            },
            addCart(index){
                console.log(index);
                if(confirm('카트에 추가하겠습니까?')){
                    localStorage.setItem('cart'+this.count, this.products[index].product_code)
                    this.cartItems = localStorage.getItem('cart'+this.count)
                    this.count = this.count+1;
                    //console.log(this.cartItems)
                }
            },
            //중복되는 코드 나중에 지울지 결정하기
            // getProducts(){
            //     this.$http.get('api/products')
            //     .then(response => {
            //         this.products = response.body//상품의 모든 것
            //         //console.log(this.products)
            //     })
            // },
            getCarts(){
                this.axios.get('api/carts')
                .then(response => {
                    this.cartItems = response.data.items;//아마 클라이언트에서 관계배열로 담긴걸 session에 넣어줄 필요 있음
                   // console.log(this.cartItems)
                })
            }

        },
        mounted:function(){//dom에 인스턴스 부착 후 호출
            console.log("mounted");
            //this.getProducts();
            //console.log(this.getProducts());
            this.getCarts();
        }
    }
</script>

<style>
 
</style>
