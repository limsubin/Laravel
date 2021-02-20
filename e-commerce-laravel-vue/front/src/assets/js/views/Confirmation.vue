<template>
<!-- 감사 메시지 표시, 자신이 배치한 주문 및 주문 상태를 볼수 있는 링크 제공 -->
    <div>
        <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2>
                <span class="title"><strong>고맙습니다!</strong></span><br>
                <span class="medium-text">주문이 접수되었습니다</span><br>
                <router-link :to="{ name: 'userboard'}" class="small-link">주문내역 보기</router-link>
            </h2>
        </div>
    </div>
</template>
<script>
    export default {}
</script>
<style scoped>
    .medium-text {
        font-size: 36px;
    }
    .small-link {
        font-size: 24px;
        text-decoration: underline;
        color: #777;
    }
    .product-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
    .hero-section {
        height: 80vh;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }
    .title {
        font-size: 60px;
    }
</style>