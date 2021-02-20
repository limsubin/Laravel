@extends('layouts.app')

@section('content')
<table class="table table-striped">
<tr>
    <th>제목</th>
    <th>작성자</th>
    <th>조회수</th>
</tr>
@foreach($msgs as $msg)
    <tr>
        <td>
            <a href="{{ route('boards.show', ['board'=>$msg->id, 'page'=>$page]) }}">{{$msg->title}}</a>
        </td>
        <td>{{$msg->user->name}}</td>
        <td>{{$msg->hits}}</td>
    </tr>
@endforeach
</table>
{{$msgs->links()}}

<button class="btn btn-primary" onClick="location.href='{{route('boards.create')}}'">글쓰기</button>
@endsection