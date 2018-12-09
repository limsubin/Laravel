@extends('layout.main')

@section('title')
    메인화면
@endsection 

@section('content')
<script>
    function prosessDelete(num) {
        var result = confirm("삭제하시겠습니까?");
        if (result) {
            location.href = "delete.php?num=" + num;
        }
    }

</script>

<!--- Heading Row --->
<img src="mainImage/2-2.jpg"  style="margin:0 auto">

    <!-- Page Content -->
    <div class="container">
    <br>
    <div class="col-md-8">
    <span style="float:right">총 {{$count}}개의 게시글</span>
    </div>
      <br>    
      <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
        @foreach($pageMsgs as $row)
         <!-- Blog Post -->
         <div class="card mb-4">
            <div class="card-body">
              <h4 class="card-title">{{$row["title"]}}</h4>
              <p class="card-text">{{$row["date"]}}</p>
              <a href="view?id={{$row['id']}}&page={{$page}}" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              작성자 : {{$row["writer"]}} | 조회수 : {{$row["inquiry"]}}
              <div style="float:right;">
              @if($row->tags->count() > 0)
                  <i class="fa fa-tag"></i>
              @endif

              @foreach($row->tags as $tag)
                <a href = "tag?name='{{$tag['name']}}'"><span class="badge badge-warning" style="float:right; margin:2px;">{{$tag['name']}}</span></a>
              @endforeach
            </div>
            </div>
          </div>
          @endforeach
          
          <!-- Pagination -->
          {{$pageMsgs->appends(Request::except('page'))->links()}}
        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
              <div class="input-group">
              <form action="search" class="form-inline" method="post" id="searchBox">
                    {{ csrf_field() }}
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="q" id="searchBox">
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="submit">Go!</button>
                </span>
                </form>
              </div>
            </div>
          </div>

          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                  <ul class="list-unstyled mb-0">
                    @foreach($article as $row)
                     <li>
                        @foreach($row->tags as $tag)
                          <a href="tag?name='{{$tag->name}}'">{{$tag->name}}</a>
                        @endforeach

                        @if ($tagCount = $row->tags->count())
                          <span>( {{$tagCount}} )</span>
                        @endif
                     </li>
                    @endforeach
                    <li>
                  </ul>
              </div>
            </div>
          </div>

          <div class="card my-4">
            <a href="write" class="btn btn-success">
              <h4>글쓰기 <i class="fa fa-pencil"></i></h4>
            </a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

@endsection