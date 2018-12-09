<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ url('comments') }}">
            @csrf
            <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
            <input type="hidden" name="commentable_id" value="{{ $model->id }}" />
            <div class="form-group">
                <label for="message">여기에 댓글을 입력하십시오:</label>
                <textarea class="form-control @if($errors->has('message')) is-invalid @endif" name="message" rows="3"></textarea>
                <div class="invalid-feedback">
                     귀하의 메시지는 필수 항목입니다.
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">등록</button>
        </form>
    </div>
</div>
<br />