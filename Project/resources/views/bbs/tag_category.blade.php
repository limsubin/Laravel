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
    </div>
      <h4><i class="fa fa-tag"></i> <span class="badge badge-warning">{{$name}}</span></h4>
      <br>    
      <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
         @foreach($article as $tag)
          <!-- Blog Post -->
          <div class="card mb-4">
            <div class="card-body">
              <h4 class="card-title"> {{$tag->title}}</h4>
              <p class="card-text"> {{$tag->date}}</p>
              <a href="view?id={{$tag->id}}" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              작성자 :  {{$tag->writer}} | 조회수 : {{$tag->inquiry}}
              <div style="float:right;">
              @if($tag->tags->count() > 0)
                  <i class="fa fa-tag"></i>
              @endif

              @foreach($tag->tags as $tags)
                <a href = "tag?name='{{$tags->name}}'"><span class="badge badge-warning" style="float:right; margin:2px;">{{ $tags->name }}</span></a>
              @endforeach
              </div>
            </div>
          </div>
        @endforeach

         {{$article->appends(Request::except('page'))->links()}}
        </div>
        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
              <div class="input-group">
              <form action="search" class="form-inline" method="post">
                    {{ csrf_field() }}
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="q">
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
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#">Web Design</a>
                    </li>
                    <li>
                      <a href="#">HTML</a>
                    </li>
                    <li>
                      <a href="#">Freebies</a>
                    </li>
                  </ul>
                </div>
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#">JavaScript</a>
                    </li>
                    <li>
                      <a href="#">CSS</a>
                    </li>
                    <li>
                      <a href="#">Tutorials</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!--write_form-->
          <div class="card my-4">
            <a href="write" class="btn btn-success"><h4>글쓰기</h4></a>
            </div>
          </div>

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection