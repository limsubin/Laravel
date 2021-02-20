@extends('layouts.app')

@section('title')
    게시글 리스트
@endsection

@section('content')
        <script>
            function prosessDelete(){
                var result = confirm("Are you suer?");
                if(result == false) return false;
            //form submit(); jQuery 문법 활용
            $('#delete').submit();//form에 id를 지정해야함
            }
        </script>

        <div class="jumbotron">
            <h1>게시글 상세내용</h1>
        </div>
            <div class="form-group">
                <label for="title">제목 :</label>
                <input type="text" id="title" value="{{$msg['Title']}}"><br>
            </div>


            <div class="form-group">
                <label for="write">작성자 :</label>
                <input type="text" id="write" value="{{$msg['Writer']}}"><br>
            </div>

            <div class="form-group">
                <label for="write">작성일자 :</label>
                <input type="text" id="regtime" value="{{$msg['Regtime']}}"><br>
            </div>

            <div class="form-group">
                <label for="write">조회수 :</label>
                <input type="text" id="hits" value="{{$msg['Hits']}}"><br>
            </div>

            <div class="form-group">
                <label for="content">내용 :</label>
                <textarea type="text" id="content" rows="5" name="content">{{$msg['Content']}}</textarea>
                <br>
                <div class="row">
                <button class="btn btn-primary" onClick='location.href="bbs?page={{$page}}"'>목록보기</button>
                <button onClick = "location.href = 'modify?num={{$msg['Num']}}'" class="btn btn-primary">수정</button>
                
                <form action="delete" method="POST" id="delete">
                   <?= csrf_field(); ?>
                   <input type="hidden" name="num" value="{{$msg['Num']}}">
                   <input type="hidden" name="page" value="{{$page}}">
                    <button class="btn btn-primary" onClick="return prosessDelete()">삭제하기</button>
                </form>
            </div>
    </div>
@endsection