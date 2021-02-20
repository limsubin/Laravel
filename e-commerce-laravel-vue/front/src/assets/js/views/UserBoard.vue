<template>
<!-- 사용자가 모든 주문을 볼 수 있는 곳(주문내역) -->
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="row">
                        <div class="col-md-4 product-box" v-for="(order,index) in orders" @key="index" :key="index">
                            <img :src="order.product.image" :alt="order.product.name" width="200">
                            <h5><span v-html="order.product.name"></span><br>
                                <span class="small-text text-muted"> {{order.product.price}}원</span>
                            </h5>
                            <hr>
                            <span class="small-text text-muted">수량: {{order.quantity}}
                                <span class="float-right">{{order.is_delivered == 1? "배송 완료" : "배송 중"}}</span>
                            </span>
                            <br><br>
                            <!-- <p><strong>Delivery address:</strong> <br>{{order.address}}</p> -->
                        </div>
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
                user : null,
                orders : []
            }
        },
        //마운트되기 전에 모든 사용자 주문을 가져오는 것을 반복하여 페이지 표시
        beforeMount(){
            this.user = JSON.parse(localStorage.getItem('user'))
            this.$http.headers.common['Content-Type'] = 'application/json'
            this.$http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token')

            this.$http.get('api/users/'+this.user.id+'/orders')
            .then(response => {
                this.orders = response.data
            })
            .catch(error => {
                console.error(error);
            })       
        }
    }
</script>
<style scoped>
    .small-text {
        font-size: 14px;
    }
    .product-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
        margin:5px;
    }
    .hero-section {
        height: 20vh;
        background: #ababab;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }
    .title {
        font-size: 60px;
        color: #ffffff;
    }
</style>