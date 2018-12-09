@extends('layout.main')

@section('title')
    메인화면
@endsection 

@section('content')

    <!---- Content ---->
    <!----image_Slider----->
    <div class="container">
        <div class="row" style="margin-top:10px;">
            <div class="cycle-slideshow" data-cycle-fx=scrollHorz data-cycle-timeout=2000>
                <div class="cycle-pager"></div>
                <img src="mainImage/1-1.png">
                <img src="mainImage/2-1.jpg">
                <img src="mainImage/3-1.jpg">
                <img src="mainImage/4-1.png">
            </div>
        </div>

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

        <div class="row" style="margin-top:50px;">
            <div style="float: none; margin: 0 auto;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-3">
                        <a href="tag?name='수의사'">
                            <img src="mainImage/s_veterinarian_out.jpg" alt=""  onmouseover="this.src = 'mainImage/s_veterinarian_over.jpg'" onmouseout="this.src='mainImage/s_veterinarian_out.jpg'" >
                       </a>
                        </div>
                        <div class="col-sm-3">
                        <a href="tag?name='훈련사'">
                            <img src="mainImage/s_handler_out.jpg" alt=""  onmouseover="this.src = 'mainImage/s_handler_over.jpg'" onmouseout="this.src='mainImage/s_handler_out.jpg'" >
                        </a>
                        </div>
                        <div class="col-sm-3">
                        <a href="tag?name='미용사'">
                            <img src="mainImage/s_hairdresser_out.jpg" alt=""  onmouseover="this.src = 'mainImage/s_hairdresser_over.jpg'" onmouseout="this.src='mainImage/s_hairdresser_out.jpg'" >
                        </a>
                        </div>
                        <div class="col-sm-3">
                        <a href="tag?name='브리더'">
                            <img src="mainImage/s_breeder_out.jpg" alt="" onmouseover="this.src = 'mainImage/s_breeder_over.jpg'" onmouseout="this.src='mainImage/s_breeder_out.jpg'" >
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection