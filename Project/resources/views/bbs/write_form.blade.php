@extends('layout.main')

@section('title')
    메인화면
@endsection 

@section('content')

    <script src ="/smarteditor2/smarteditor2-2.8.2.3/js/HuskyEZCreator.js"></script>
<!--    <script src="se2/photo_uploader/plugin/hp_SE2M_AttachQuickPhoto.js"></script>-->

    <script>
        var oEditors = [];
        $(function(){
      nhn.husky.EZCreator.createInIFrame({
          oAppRef: oEditors,
          elPlaceHolder: "ir1", //textarea에서 지정한 id와 일치해야 합니다. 
          //SmartEditor2Skin.html 파일이 존재하는 경로
          sSkinURI: "/smarteditor2/smarteditor2-2.8.2.3/SmartEditor2Skin.html",  
          htParams : {
              // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
              bUseToolbar : true,             
              // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
              bUseVerticalResizer : true,     
              // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
              bUseModeChanger : true,         
              fOnBeforeUnload : function(){
                   
              }
          }, 
          fOnAppLoad : function(){
              //기존 저장된 내용의 text 내용을 에디터상에 뿌려주고자 할때 사용
//              oEditors.getById["ir1"].exec("PASTE_HTML", ["기존 DB에 저장된 내용을 에디터에 적용할 문구"]);
          },
          fCreator: "createSEditor2"
      });
      
      //저장버튼 클릭시 form 전송
      $("#save").click(function(){
          oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);
          $("#frm").submit();
      });  
            
});
    </script>

    <!-- Page Content -->
    <div class="container">
        <!-- Heading Row -->
        <div class="row my-4">
            <div class="col-lg-10">
                <h1>Business Name or Tagline</h1>
            </div>
        </div>

        <!---- Content Row ----->
        <div class="row">
            <div class="col-md-10 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                    <form action="write" method="post">
                         {{csrf_field()}}
                        
                            <div class="form-group">
                                <label for="usr">제목</label><br>
                                <input name="title" type="text" placeholder="title" class="form-control" required>
                            </div><br>

                            <div class="form-group">
                                내용<br>
                                <textarea name="content" id="ir1" class="form-control" cols="30" rows="10"  style="width:700px; height:350px;" placeholder="content" required></textarea>
                                <input type="hidden" value="{{Auth::user()->name}}" name="writer">
                                <br>
                                <span>태그</span>
                                <div style="width: 900px; margin: 0px auto;">
	                                <input name="tags" id="input-tags" style="width:500px !important" required/>              
                                </div>
                                <script type="text/javascript">
                                    $('#input-tags').tagsInput();
                                </script>
                                <br>
                                <div class="card-footer">
                                    <div class="form-group">
                                        <button type="submit" id="save" class="btn btn-primary">
                                            <i class="fa fa-check-square-o"></i> 글등록
                                        </button>
                                        <button type="button" value="글목록" class="btn btn-danger" onClick="location.href='board'">
                                            <i class="fa fa-th-list"></i> 글목록
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 