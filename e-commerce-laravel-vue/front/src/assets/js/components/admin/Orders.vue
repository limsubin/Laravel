<template>
	<div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td></td>
                    <td>Product</td>
                    <td>Quantity</td>
                    <td>Cost</td>
                    <td>Delivery Address</td>
                    <td>is Delivered?</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(order,index) in orders" @key="index" :key=index>
                    <td>{{index+1}}</td>
                    <td v-html="order.product.name"></td>
                    <td>{{order.quantity}}</td>
                    <td>{{order.quantity * order.product.price}}</td>
                    <td>{{order.address}}</td>
                    <td>{{order.is_delivered == 1? "Yes" : "No"}}</td>
                    <td v-if="order.is_delivered == 0"><button class="btn btn-success" @click="deliver(index)">Deliver</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
	export default {
        data(){
            return {
                orders : []
            }
        },
        //구성요소가 렌더링되지 건에 모든 주문의 배치 가져오기
        beforeMount(){
            this.$http.get('http://localhost:8000/api/orders/')
            .then(response => {
                this.orders = response.data
            })  
        },
        methods : {
            //전달버튼 클릭시 작동
            //주문을 전달하기 위한 API를 호출
            deliver(index){
                let order = this.orders[index]
                this.$http.patch('http://localhost:8000/api/orders/'+order.id+'/deliver')
                .then(response => {
                    this.orders[index].is_delivered = 1
                    this.$forceUpdate()//페이지에 즉시 반영되도록 변경사항을 반영하기 위해 호출
                })
                .catch(error => {
                    console.error(error);
                })   
            }
        }
    }
</script>