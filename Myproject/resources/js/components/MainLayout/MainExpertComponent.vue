<template>
 <transition-group class="animated swing infinite">
    <!-- Call to Action Well -->
        <div class="row" style="margin-top:50px;">
            <div style="float: none; margin: 0 auto;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-2.2">
                           <a href="tag?name='전문가'">
                             <img src="mainImage/s_cover_out.jpg" onmouseover="this.src = 'mainImage/s_cover_over.jpg'" onmouseout="this.src='mainImage/s_cover_out.jpg'" alt="">
                           </a> 
                        </div>
                        <div class="col-sm-2.2">
                            <img src="mainImage/bbs_detail.jpg" alt="">
                        </div>
                        <div class="col-sm-2.2">
                            <img src="mainImage/bbs_detail2.jpg" alt="">
                        </div>
                        <div class="col-sm-2.2">
                            <img src="mainImage/bbs_detail3.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
 </transition-group>
</template>

<script>
export default {

}
</script>

<style scoped>
    .list-enter-active, .list-leave-active{
        transition: all 1s;
    }
    .list-enter, .list-leave-to{
        opacity: 0;
        transform: translateY(30px);
    }
</style>
