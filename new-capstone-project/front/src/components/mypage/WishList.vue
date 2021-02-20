<template>
<div>
    <div class="container">
        <h1>WishList</h1>
        <table class="table">
            <tr>
                <th>상품</th>
                <th>갯수</th>
                <th>가격</th>
                <th>총계</th>
                <th></th>
            </tr>
            <tr v-for="(cartItem,rowId) in carts.items">
                <td>
                    <span v-text="cartItem.name"></span><br>（사이즈： <span v-text="cartItem.options.size"></span>）
                </td>
                <td v-text="cartItem.qty"></td>
                <td v-text="cartItem.price"></td>
                <th v-text="cartItem.subtotal"></th>
                <td class="text-right">
                    <button type="button" class="btn btn-danger btn-sm" @click="removeItem(rowId)">삭제</button>
                </td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <th>총계</th>
                <th v-text="carts.subtotal"></th>
            </tr>
            <tr>
                <td colspan="3"></td>
                <th>세금</th>
                <th v-text="carts.tax"></th>
            </tr>
            <tr>
                <td colspan="3"></td>
                <th>합계</th>
                <th v-text="carts.total"></th>
            </tr>
        </table>
        <div class="text-right">
            <button type="button" class="btn btn-success">주문하기</button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return{
           carts: {}
        }
    },
  methods: {
    removeItem(rowId){
      var cart = this.carts.items[rowId]//현재 로그인한 사용자
      //console.log(cart)
      if(confirm("삭제하겠습니까?")){
        this.$http.post('api/carts/'+cart.id, cart)//methods : delete
          .then(response=>{
            this.getCarts()
          })
      }
    },
    getCarts(){
      this.$http.get('api/carts')
        .then(response=>{
          this.carts = response.data
          console.log(this.carts)
        })
    }
  },
  mounted:function(){
    this.getCarts();
  }
}
</script>

<style>

</style>
