<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

        <!-- Bootstrap core CSS -->
        <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/small-business.css" rel="stylesheet">

        <!-----google fonts------->
        <link href="https://fonts.googleapis.com/css?family=Nanum+Myeongjo" rel="stylesheet">

        <!---image_Slider---->
        <link rel="stylesheet" href="css/imageSlider.css">
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>

        <!----cycle2 js파일연결---->
        <script src="http://malsup.github.com/jquery.cycle2.js"></script>

        <!-----header_menu------>
        <link rel="stylesheet" href="/css/header_menu.css">

        <!----bootstrap---->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!---Main_SideMenu--->
       <script src="/MainSideMenu/MainSideMenu.js"></script>
       <link rel="stylesheet" href="/MainSideMenu/MainSideMenu.css">

        <!-- tag -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css" rel="stylesheet"> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>

        <!-- sweetalert -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand navbar-dark" style="background-color:#52387B;height:40px;">
    <div class="container">
    
    <!--login_logout-->
        <ul class="navbar-nav ml-auto" style="margin-left: 0px">
        @guest
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('login') }}">LogIn</a>
            </li>

            <li class="nav-item active">
               <a class="nav-link" href="{{ route('register') }}">회원가입</a>
            </li>
       @else
            <li class="nav-item active">
               <div class='menu-bar'>
                  <ul class="menu">
                    <li><a href="#">{{ Auth::user()->name }}</b>님 환영합니다</a>
                      <ul>
                        <li><a href="myAricles">내가 작성한 글</a></li>
                      </ul>
                    </li> 
                  </ul>
                </div>
            </li>
            <li class="nav-item active">
            <a class="nav-link" href="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                 {{ __('Logout') }}
            </a>

            <form id="logout-form" action="logout" method="POST" style="display: none;">
                 @csrf
            </form>
            </li>
     @endguest

        </ul>
    </div>
</nav>

<!----content---->
<div class="container">
    <a href="/bbs"><img src="/img/title.png" alt="" style="width:190px;margin:20px;"></a>
</div>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light" style="border-bottom: 2px solid #C2CFDD;border-top: 1px solid lightgray;">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
        <div class="container">
            <ul class="nav navbar-nav">
                <li class="two">
                    <b><a class="nav-link" href="board" style="color:#55397F;">펫노트</a></b>
                </li>
                <li class="three">
                    <b><a class="nav-link" href="tag?name='강아지'" style="color:#FF927D;">강아지</a></b>
                </li>
                <li class="four">
                    <b><a class="nav-link" href="tag?name='고양이'" style="color:#FF927D;">고양이</a></b>
                </li>
                <li class="four">
                    <b><a class="nav-link" href="tag?name='소동물'" style="color:#FF927D;">소동물</a></b>
                </li>
                <li class="two">
                    <b><a class="nav-link" href="hospital" style="color:#55397F;">동물병원</a></b>
                </li>
            </ul>
        </div>
    </div>
</nav>
           @include('sweet::alert')    
        <div>
           @include('flash::message')
           @yield('content')
        </div>
        
    <br>
    <footer class="py-5 bg-light" style="font-family: 'Nanum Myeongjo', serif;padding:0px;">
        <div class="container">
            <p class="m-0 text-center text-dark">
                유기견 보호센터 소개 | 이용약관 | 개인정보취급방침 | 책임의한계와 법적고지 | 이메일 무단수집거부 | 이용안내 | 빠른질문/답변 게시판</p><br><br>
            <p class="m-0 text-center text-dark">
                유기견보호센터에 문의사항이 있으신분은 <b>[질문/답변]</b>게시판에 글을 남겨주시면 빠르게 답변해드립니다.<br/><br/>
            </p>
            <p class="m-0 text-center text-dark">
                상호명 : 유기견보호센터 사업자번호 : 122-18-78609<br/> Copyright2003-2014 by 유기견보호센터. All rights reserved. 관리자 E-mail : ddh05136@naver.com<br/> Copyright &copy; Your Website 2017
            </p>

            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        </div>
    </footer>
</body>
</html>