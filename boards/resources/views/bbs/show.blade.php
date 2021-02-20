@extends('layouts.app')

@section('content')
    <table class="table">
        <tr>
            <td>제목</td>
            <td>{{$board->title}}</td>
        </tr>
        <tr>
            <td>작성자</td>
            <td>{{$board->user->name}}</td>
        </tr>
        <tr>
            <td>내용</td>
            <td>{{$board->content}}</td>
        </tr>
        <tr>
            <td>조회수</td>
            <td>{{$board->hits}}</td>
        </tr>
        <tr>
            <td>생성일</td>
            <td>{{$board->created_at}}</td>
        </tr>
        <tr>
				<th>첨부파일</th>
				<td>			
					<ul>
					@forelse($board->attachments as $attach)
						<li>
							<a href="{{'/files/' . Auth::user()->id . '/' . $attach->filename}}">
							{{$attach->filename}}
							</a>
						</li>
					@empty <li>첨부파일 없음</li>	
					@endforelse	
					</ul>
				</td>
			</tr>		
    </table>

    <hr>
    <h3>댓글리스트</h3>
    <table  class="table">
        <tr>
          <th>작성자</th>
          <th>내용</th>
        </tr>
        @foreach($board->comments as $c)
            <tr>
                <td>{{$c->user->name}}</td>
                <td>{{$c->content}}</td>
            </tr>
        @endforeach
    </table>
    <div class="row">
        <button class="btn btn-primary" onclick="location.href='{{route('boards.index', ['page'=>$page])}}'">목록보기</button>
        <!-- onclick="location.href='/boards?page={{$page}}'" -->
        {{--@if($board->user_id == Auth::user()->id)--}}
        <button class="btn btn-warning" onclick="location.href='{{route('boards.edit',['board'=>$board->id, 'page'=>$page])}}'">수정</button>
        <button class="btn btn-danger">삭제</button>
        {{--@endif--}}
    </div>
@endsection