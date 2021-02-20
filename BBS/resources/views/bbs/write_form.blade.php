@extends('layouts.app')
@section('title')
    글쓰기
@endsection
  
@section('content')
   <div class="container">
    <form action="write" method="post">
       <?= csrf_field(); ?>
        <div class="form-group">
            <label for="title">제목 :</label>
            <input type="text" id = "title" name="title" required><br> 
        </div>
            
            
        <div class="form-group">
           <label for="write">작성자 :</label>
           <input type="text" id="write" name="writer" required><br> 
        </div>   
           
        <div class="form-group"> 
            <label for="content">내용 :</label>
            <textarea name="content" id="content" rows="5" name="content" required></textarea><br>
            <button type="submit" class="btn btn-primary">글등록</button>
        </div>
       
    </form>
    
    </div>
@endsection