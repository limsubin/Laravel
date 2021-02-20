<template>
<!-- 사용자가 모든 주문을 볼 수 있는 곳(주문내역) -->
<div>
    <div class="container">
    <h3>Mypage</h3>
    <hr>
    <div class="row">
        <h1 class="my-4">Order List</h1><br>
        <div class="col-lg-4 mb-4">
          <div class="card h-200">
            <div class="card-body">
                <p class="card-text"><img src="src\assets\img\box.jpg" alt="" weight="25%" height="25%"></p>
            </div>
            <h4 class="card-header center">결제 확인/완료</h4>
          </div>
        </div>

    <div class="col-lg-4 mb-4">
        <div class="card h-200">
            <div class="card-body">
             <p class="card-text"><img src="src\assets\img\car.jpg" alt="" weight="25%" height="25%"></p>
            </div>
         <h4 class="card-header center">배송 중</h4>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card h-200">
         <div class="card-body">
            <p class="card-text"><img src="src\assets\img\return.jpg" alt="" weight="25%" height="25%"></p>
         </div>
         <h4 class="card-header center">취소/반품/교환</h4>
        </div>
    </div>

    <div class="col-md-12">
    <br>
     <div class="row">
<table>
  <tr>
    <th></th>
    <th>상품명</th>
    <th>가격</th>
    <th>수량</th>
    <th>교환/환불하기</th>
    <th>배달현황</th>
  </tr>
   <tr v-for="(order,index) in orders" @key="index" :key="index">
       <!--  :alt="order.product.name" -->
        <th><input type="checkbox"></th>
        <th>
            <!-- <img :src="order.product.image" width="100"> -->
            <span v-html="order.product.name"></span>
        </th>
        <th>
            <span class="small-text text-muted"> {{order.product.price}}원</span>
        </th>
        <th>
            <span class="small-text text-muted">{{order.quantity}}</span>
        </th>
        <th><a href="">교환/환불하기</a></th>
        <th>
            <span style="color:blue">{{order.is_delivered == 1? "배송 완료" : "배송 중"}}</span>
        </th>
      </tr>
     </table>
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
                //user : [],//null
                orders : [],
                count: 0
            }
        },
        //마운트되기 전에 모든 사용자 주문을 가져오는 것을 반복하여 페이지 표시
        beforeMount(){
            this.$http.get('api/users/1/orders')//this.user.id
            .then(response => {
                this.orders = response.data
                //this.user = response.data.user,
                //console.log(response.data.user.id)
            })
            .catch(error => {
                console.error(error);
            })       
        }
    }
</script>
<style scoped>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
  font-size:20px;
}

a{
    color:red;
}
</style>