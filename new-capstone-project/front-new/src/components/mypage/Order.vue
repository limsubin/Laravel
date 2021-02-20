<template>
<!-- 사용자가 모든 주문을 볼 수 있는 곳(주문내역) -->
<div>
 <div class="container">
    <h3>Mypage</h3>
    <hr>
    <h1 class="my-4">Order List</h1><br>

    <div class="row" style="margin:10px;background-color:#EEEFF3;height:310px">
        <div class="line">
            <!-- <img src="static/img/boss.png" alt="" weight="50px" height="50px" class="user"> -->
            <div class="text">GoldSangWon 님의 결재현황</div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="sd">
            <h4 class="center" style="margin-left:10px;">배송중</h4>
            <div>
               <img src="static/img/car3.png" alt="" weight="100px" height="100px">
               <div class="count">{{this.orders.length}}</div>
            </div>
          </div>
        </div>

    <div class="col-lg-4 mb-4">
          <div class="sd">
            <h4 class="center" style="margin-left:10px;">배송완료</h4>
            <div>
               <img src="static/img/box2.png" alt="" weight="100px" height="100px">
               <div class="count">0</div>
            </div>
          </div>
    </div>

    <div class="col-lg-4 mb-4">
          <div class="sd">
            <h4 class="center" style="margin-left:10px;">취소/반품/교환</h4>
            <div>
               <img src="static/img/return2.png" alt="" weight="100px" height="100px">
               <div class="count">0</div>
            </div>
          </div>
    </div>
    </div>

<div class="row" style="margin:20px;">
    <div class="col-md-12">
    <br>
     <div class="row">
             <div class="tit_month">
                 <img src="static/img/line.png" alt="" style="width:100%">
                 <h4 style="position: relative;top:-45px">2019.05</h4>
             </div>
         </div>

<table>
  <tr>
    <th>번호</th>
    <th>상품명</th>
    <th>수량</th>
    <th>가격</th>
    <!-- <th>교환/환불하기</th> -->
    <th>배달현황</th>
  </tr>
  <tr>
    <th>1</th>
    <th>
        <img src="static/img/sample.jpg" alt="" width="100px" height="100px">
        <span class="center">르씨엘 라벤더 에센셜 오일</span>
    </th>
    <th>
        <select class="form-control">
            <option>1</option>
        </select> 
    </th>
    <th>５００円</th>
    <th style="color:blue">배송중</th>
    </tr>

    <tr>
        <th>2</th>
         <th>
             <img src="static/img/sample.jpg" alt="" width="100px" height="100px">
             <span class="center">유칼립투스 에센셜 오일</span>
        </th>
        <th>
            <select class="form-control">
             <option>1</option>
            </select> 
         </th>
        <th>４００円</th>
        <th style="color:blue">배송중</th>
    </tr>
   <!-- <tr v-for="(order,index) in orders" @key="index" :key="index">
        :alt="order.product.name"
        <th><input type="checkbox"></th>
        <th>
            <img :src="order.product.image" width="100">
            <span v-html="order.name"></span>
        </th>
        <th>
            <span class="small-text text-muted"> {{order.price}}원</span>
        </th>
        <th>
            <span class="small-text text-muted">{{order.quantity}}</span>
        </th>
        <th><a href="">교환/환불하기</a></th>
        <th>
            <span style="color:blue">{{order.is_delivered == 1? "배송 완료" : "배송 중"}}</span>
        </th>
      </tr> -->
     </table>
   </div>
  </div>
 </div>

</div>
</template>

<script>
    export default {
        data(){
            return {
                user : this.$auth.getAuthenticatedUser(),
                orders : [],
                count: 0
            }
        },
        //마운트되기 전에 모든 사용자 주문을 가져오는 것을 반복하여 페이지 표시
        beforeMount(){
            this.axios.get('api/users/GoldSangWon@gmail.com/orders')//this.user.id//=4
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
/* table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
  font-size:20px;
} */

table {
    width: 100%;
    border-top: 1px solid #DEE0E2;
    border-collapse: collapse;
    font-size: 18px;
}

th, td {
    border-bottom: 1px solid #DEE0E2;
    padding: 10px;
}

a{
    color:red;
}

.sd{
    margin: 50px 0px 0px 60px;
}

.count{
    position: relative;
    left: 120px;
    top: -100px;
    font-size: 60px;
}

.line{
    background-color: #525F78;
    height: 60px;
    width: 100%;
    padding-left: 5px;
}

.text{
    color: white;
    float: left;
    /* border-right: solid 1px rgb(225, 228, 233); */
    margin: 15px;
    font-size: 20px;
    padding-right: 20px;
}

.tit_month{
    width: 100%;
    height: 39px;
    margin: -9px 0;
    /* background-image: url("static/img/line.png") repeat-x; */
    text-align: center;
    margin-bottom: 35px;
}

.user{
  background-color: white;
  /* border: solid 5px lightgray; */
  border-radius: 50%;
  width: 150px;
  height: 150px;
  padding: 10px;
}

.form-control{
    width: 100px;
}

.center{
    margin-left:10px;
}
/* th{ 
    text-align: center;
} */
</style>