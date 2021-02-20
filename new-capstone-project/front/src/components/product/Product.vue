<template>
    <div class="col-md-4">
        <div class="thumbnail">
            <!-- <img :src="'http://localhost:8000/'+product.image" alt=""> -->
            <img src="https://images-na.ssl-images-amazon.com/images/I/61QmgRXnn3L._SY355_.jpg" alt="">
            <div class="caption">
                <h3>{{product.name}}</h3>
                <p>{{product.price}}</p>
                <hr>
                <p>
                  <a href="#" class="btn btn-default" @click="$emit('addTo-Cart')">
                      Wish list
                  </a>
                  <router-link class="btn btn-success"
                        :to = "'/products/' + product.id + '/view'">
                        Buy
                  </router-link>
                </p>
                <hr>
                <!-- v-if : 로그인 사용자에게만 delete버튼 나옴 -->
                <p v-if="product.user_id == authenticatedUser.id">
                    <a href="#" class="btn btn-danger" role="button" @click="$emit('delete-product')">Delete</a>
                    <router-link class="btn btn-success"
                        :to = "'/products/' + product.id + '/edit'">
                        Edit
                    </router-link>
                </p>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    //authenticatedUser : Products.vue 안에 있는 return this.$auth.getAuthenticatedUser()(Auth.js)라는 사용자 정보가 상품 하나하나에 데이터 반환
    //product:상품정보, authenticatedUser:사용자정보
    props:['product', 'authenticatedUser'],
}
</script>

<style>

</style>
