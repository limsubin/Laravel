@extends('layouts.app')
 
@section('title') 
 게시글 리스트 
@endsection

@section('content')
    <div class="container">
        <table class="table table-hover">
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일시</th>
                <th>조회수</th>
            </tr>
 
                @foreach($pageMsgs as $row)
                <tr>
                    <th>
                        {{$row["Num"]}}
                    </th>
                    <th>
                        <a href="view?num={{$row['Num']}}&page={{$page}}">{{$row["Title"]}}</a>

                    </th>
                    
                    <th>
                        {{$row["Writer"]}}
                    </th>
                    <th>
                        {{$row["Regtime"]}}
                    </th>
                    <th>
                        {{$row["Hits"]}}
                    </th>
                </tr>
                @endforeach
        </table>
        <div class="float-right">
        <input type="submit"  class="btn btn-primary" value="글쓰기" onClick = 'location.href="write"'>
        </div>
        
    </div>
    <div class="container">
    <ul class="pagination">
       
         @if ($startPage > 1)
            <li class="page-item">
               <a href="bbs?page={{$startPage - $numPageLinks}}" class="page-link">&lt;</a>
            </li>
         @endif

        @for($i = $startPage; $i <= $endPage; $i++)
               @if($i == $page)
                    <li class="page-item"><a href="" class="page-link"><b>{{ $i }}</b></a></li>
               @else
                    <li class="page-item"><a href="bbs?page={{ $i }}" class="page-link">{{ $i }}</a></li>
               @endif
        @endfor


        @if($endPage < $totalPages)
            <li class="page-item"><a href="bbs?page={{ $endPage+1 }}" class="page-link">&gt;</a></li>
        @endif
    </ul>
    </div>
    
@endsection
