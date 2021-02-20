@auth
    @if($model->comments->count() < 1)
        <p class="lead">아직 댓글이 작성된 것이 없습니다</p>
    @endif

    <ul class="list-unstyled">
        @foreach($model->comments->where('parent', null) as $comment)
            @include('comments::_comment')
        @endforeach
    </ul>

    @include('comments::_form')
@else
    @if($model->comments->count() < 1)
        <p class="lead">아직 댓글이 작성된 것이 없습니다</p>
    @endif

    <ul class="list-unstyled">
        @foreach($model->comments->where('parent', null) as $comment)
            @include('comments::_comment')
        @endforeach
    </ul>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">로그인을 해주십시오</h5>
            <p class="card-text">댓글을 게시하려면 로그인을 해야합니다</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
        </div>
    </div>
@endauth