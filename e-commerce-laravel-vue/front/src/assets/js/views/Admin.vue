<template>
<!-- 관리 대시보드 : 신제품 추가, 기존 제품 수정되며 주문이 배송됨을 설정 -->
<!-- 부모 구성 요소 내부의 구성요소로 사용 -->
    <div>
        <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class="title">Admin Dashboard</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <ul style="list-style-type:none">
                      <li class="active"><button class="btn" @click="setComponent('main')">Dashboard</button></li>
                      <li><button class="btn" @click="setComponent('orders')">Orders</button></li>
                      <li><button class="btn" @click="setComponent('products')">Products</button></li>
                      <li><button class="btn" @click="setComponent('users')">Users</button></li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <component :is="activeComponent"></component>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
//아직 만들지 않은 네 개의 구성 요소를 가져와서 등록
    import Main from '../components/admin/Main'
    import Users from '../components/admin/Users'
    import Products from '../components/admin/Products'
    import Orders from '../components/admin/Orders'
    
    export default {
        data(){
            return {
                user : null,
                activeComponent : null
            }
        },
        components : {
            Main, Users, Products, Orders
        },
        beforeMount(){
            this.setComponent(this.$route.params.page)
            this.user = JSON.parse(localStorage.getItem('user'))
            this.$http.headers.common['Content-Type'] = 'application/json'
            this.$http.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token')
        },
        //구성 요소간 전환을 위한 탐색 정의
        methods : {
            //탐색 링크는 setComponent메서드를 호출한 다음 값을 전달
            setComponent(value){
                switch(value) {
                    case "users":
                        this.activeComponent = Users
                        this.$router.push({name : 'admin-pages', params : {page: 'users'}})
                        break;
                    case "orders":
                        this.activeComponent = Orders
                        this.$router.push({name : 'admin-pages', params : {page: 'orders'}})
                        break;
                    case "products":
                        this.activeComponent = Products
                        this.$router.push({name : 'admin-pages', params : {page: 'products'}})
                        break;
                    default:
                        this.activeComponent = Main
                        this.$router.push({name : 'admin'})
                        break;
                }
            }
        }
    }
</script>
<style scoped>
    .hero-section {
        height: 20vh;
        background: #ffffff;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }
    .title {
        font-size: 60px;
        color: #ffffff;
    }
</style>