@extends('layout.main')

@section('title')
메인화면
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

<!-- Page Content -->
<div class="container">
    <!-- Heading Row -->
    <div class="row my-4">
        <div class="col-lg-10">
            <h1>펫노트</h1>
        </div>
    </div>
    <hr style="height:3px;background-color:black;">

    <div class="card-body">
        <div class="form-group">
            <span>제목</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;
            <span>{{$articles['title']}}</span>
            <hr style="margin:0 auto">
        </div>
        <span>글쓴이</span>&nbsp;&nbsp;|
        &nbsp; <span>{{$articles['writer']}}</span>
        <hr style="margin:5px">
        <span>작성일</span>&nbsp;&nbsp;|
        &nbsp; <span>{{$articles['date']}}</span>

        <div class="form-group">
            <hr style="margin:5px">
            <h6 style="text-align:center">내용</h6>
            <hr style="margin:5px">
            <span>
                <?=$articles['content']?></span>
        </div>

        <div class="form-group">
            <br />

            @foreach($articles->tags as $tag)
            <a href=""><span class="badge badge-warning" style="float:right; margin:2px;">{{ $tag->name }}</span></a>
            @endforeach
            <br>
        </div>

        <div class="card-footer">
            <div class="form-group">
                <button type="button" value="글목록" class="btn btn-primary" onClick="location.href='board'">
                    <i class="fa fa-th-list"></i> 글목록
                </button>
               {{--@if($articles->writer == Auth::user()->name)--}} 
                <div style="float:left;margin-right:5px">
                    <form action="delete" method="POST" id="delete">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$articles['id']}}">
                        <input type="hidden" name="page" value="{{$page}}">
                        <button class="btn btn-danger" onClick="return prosessDelete()">
                            <i class="fa fa-times"></i> 삭제하기
                        </button>
                    </form>
                </div>
                {{--@endif--}}
                <button type="button" value="수정" onClick="location.href='update?id={{$articles['id']}}'" class="btn btn-success">
                    <i class="fa fa-pencil"></i> 수정
                </button>
            </div>
        </div>
    </div>

    <!--comments-->
    <hr>
    @comments(['model' => $articles])
    @endcomments
</div>
@endsection
