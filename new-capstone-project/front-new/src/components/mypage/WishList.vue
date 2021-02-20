<template>
<div>
<div class="container">
  <!-- <div>
    <h3>주문/결제</h3>
    <div class="row">
      <h3>
        <div class="circle"></div>
        장바구니
      </h3>
    </div>
    <hr style="border:solid">
  </div> -->
    <div class="row margin">
      <div class="col">
        <ul class="progressbar">
          <li class="active">장바구니</li>
          <li>주문결제</li>
          <li>주문완료</li>
        </ul>
      </div>
    </div>

    <div class="row">
    <div class="col-sm-9">
        <div class="product">상품정보</div>
        <table class="table shopping-cart-wrap">
        <thead class="text-muted">
            <tr>
              <th scope="col">번호</th>
              <th scope="col">상품명</th>
              <th scope="col" width="120">수량</th>
              <th scope="col" width="120">가격</th>
              <th scope="col" class="text-right" width="200"></th>
            </tr>
        </thead>
        <tbody>
          <!-- <div>{{ this.reversedMessage }}</div> -->
          <!-- <div style="display:none">{{this.getCarts()}}</div> -->
        <tr v-for="(cartproduct, index) in reversedMessage">
        <td>{{index+1}}</td>
        <td>
            <div class="media">
                <div class="img-wrap"><img :src="cartproduct.product_img" alt="" width="100px" height="100px"></div>
                <div class="media-body">
                    <h6 class="title text-truncate">{{cartproduct.product_name}}</h6>
                </div>
            </div> 
        </td>
        <td> 
            <select class="form-control">
                <option>1</option>
            </select> 
        </td>
        <td> 
          <div class="price-wrap"> 
            <var class="price">{{cartproduct.product_price}}</var> 
          </div> <!-- price-wrap .// -->
        </td>
            <td class="text-right">
            <button class="btn btn-outline-danger btn-round" @click="removeItem(index)"> × </button>
            </td>
        </tr>
        <!-- <tr>
          <td>2</td>
            <td>
        <div class="media">
            <div class="img-wrap"><img src="static/img/sample.jpg" alt="" width="100px" height="100px"></div>
            <div class="media-body">
                <h6 class="title text-truncate">아로마 오일 </h6>
            </div>
        </div> 
            </td>
            <td> 
                <select class="form-control">
                    <option>1</option>
                </select> 
            </td>
            <td> 
                <div class="price-wrap"> 
                    <var class="price">450円</var> 
                </div>  price-wrap .// -->
            <!-- </td>
            <td class="text-right">
                <a href="" class="btn btn-outline-danger btn-round">×</a>
            </td>
        </tr> -->
        </tbody>
        </table>
        <br>

        <!-- 결제방법 -->
        <div class="product">결제방법 선택</div>
        <table class="table shopping-cart-wrap">
          <thead class="text-muted">
              <tr>
                <th colspan="4" scope="col">다른결제 선택</th>
              </tr>
          </thead>
        <tbody>
          <tr>
            <td style="width:100px">
              <div class="payment">
                <img src="static/img/kakaopay.png" alt="" width="70px" height="70px">
              </div>
            </td>
            <td style="width:100px">
              <div class="payment" style="border:solid 1px lightgray">
                <img src="static/img/NH.jpg" alt="" width="70px" height="70px">
              </div>
            </td>
            <td style="width:100px">
              <div class="payment" style="border:solid 1px lightgray">
                <img src="static/img/KB.jpg" alt="" width="70px" height="70px">
              </div>
            </td>
            <td></td>
          </tr>
        </tbody>
        </table>
    </div> 
    
    <div class="col-sm-3" style="height:185px; background-color:#E9EDF6;">
      <!-- <table>
        <tr>
          <th> -->
              <div class="dlist-align" style="margin-top: 15px;">
                  <div class="total">Total price: </div><br>
                  <div class="text-right">{{this.price}}円</div>
              </div>
              <div class="dlist-align">
                  <div class="total">Tax:</div><br>
                  <div class="text-right">{{Math.floor(this.price*0.1)}}円</div>
              </div>
              <div class="dlist-align h4">
                  <div class="total">Total:</div><br>
                  <div class="text-right"><strong>{{this.price + Math.floor(this.price*0.1)}}円</strong></div>
              </div>
              <br>
              <div class="text-right">
                <button type="button" class="btn btn-success" style="width:250px;">결재하기</button>
              </div>
          <!-- </th>
        </tr>
      </table> -->
            
    </div> 
    </div>
</div>
</div>
</template>

<script>
export default {
    data(){
        return{
           carts: {},
           products:[],
           cartproducts:[],
           Item:[],
           price:0,
           count:0
        }
    },
    computed:{
      reversedMessage: function () {
        //this.getCarts();
        this.axios.get('api/products')
          .then(response => {
              this.products = response.data
              //console.log(this.products)
              // var count = 0;
              this.getCarts();
               //this.cartproducts[0] = this.products[3].product_code
        })
        //return this.products
        return this.cartproducts;
        
    }
  },
  created(){
    this.getting(); 
  },
  methods: {
    removeItem:function(index){
      //var cart = this.carts.items[index]//현재 로그인한 사용자
      //console.log(cart)
      if(confirm("삭제하겠습니까?")){
        //this.axios.post('api/carts/'+cart.id, cart)//methods : delete
        //  .then(response=>{
            //this.getCarts()
            localStorage.removeItem('cart'+index);
         // })
         console.log("삭제")
      }
    },
    getCarts(){
      // this.axios.get('api/carts')
      //   .then(response=>{
      //     this.carts = response.data
      //     console.log(this.carts)
      //   })
      for(var i = 0; i < 20; i++){
          this.Item[this.count] = localStorage.getItem('cart'+this.count);
          if(this.products[i].product_code == this.Item[this.count]){
              this.cartproducts[this.count] = this.products[i];
              this.price += this.products[i].product_price;
              this.count++;
              i = 0;
          }
      }
      //return this.cartproducts
    },
    getting(){
      return this.products;
    }
  }
  
}
</script>

<style scoped>
.col-sm-3{
  margin-top: 55px;
}

.product{
  font-size: 25px;
  margin: 10px;
}

table{
  border-top: solid;
  text-align: center;
}

.total{
  float: left;
}

.circle{
  float: right;
  width: 50px;
  height: 50px;
  background-color: #898989;
  border-radius: 50%;
}

/* progress bar */
  .progressbar {
      counter-reset: step;
  }
  .progressbar li {
      list-style-type: none;
      width: 30%;
      float: left;
      font-size: 25px;
      position: relative;
      text-align: center;
      text-transform: uppercase;
      color: #7d7d7d;
  }
  .progressbar li:before {
      width: 50px;
      height: 50px;
      content: counter(step);
      counter-increment: step;
      line-height: 44px;
      border: 2px solid #7d7d7d;
      display: block;
      text-align: center;
      margin: 0 auto 10px auto;
      border-radius: 50%;
      background-color: white;
  }
  .progressbar li:after {
      width: 100%;
      height: 2px;
      content: '';
      position: absolute;
      background-color: #7d7d7d;
      top: 26px;
      left: -50%;
      z-index: -1;
  }
  .progressbar li:first-child:after {
      content: none;
  }
  .progressbar li.active {
      color: green;
  }
  .progressbar li.active:before {
      border-color: #55b776;
  }
  .progressbar li.active + li:after {
      background-color: #55b776;
  }

  .margin{
    margin-bottom: 20px;
  }

.payment{
  border: solid 1px indianred;
  width: 85px;
  height: 85px;
  padding: 5px;
}
</style>
