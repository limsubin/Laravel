 @extends('layout.main') 
 @section('title') 
 메인화면 
 @endsection 
 @section('content')
<script src="smarteditor2/smarteditor2-2.8.2.3/js/HuskyEZCreator.js"></script>

<script>
    var oEditors = [];
    $(function() {
        nhn.husky.EZCreator.createInIFrame({
            oAppRef: oEditors,
            elPlaceHolder: "ir1", //textarea에서 지정한 id와 일치해야 합니다. 
            //SmartEditor2Skin.html 파일이 존재하는 경로
            sSkinURI: "smarteditor2/smarteditor2-2.8.2.3/SmartEditor2Skin.html",
            htParams: {
                // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                bUseToolbar: true,
                // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                bUseVerticalResizer: true,
                // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                bUseModeChanger: true,
                fOnBeforeUnload: function() {

                }
            },
            fOnAppLoad: function() {
            },
            fCreator: "createSEditor2"
        });

        //저장버튼 클릭시 form 전송
        $("#save").click(function() {
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
            <h3>{{$member["writer"]}}님의 글을 수정하고 있습니다</h3>
        </div>
    </div>

    <!---- Content Row ----->
    <div class="row">
        <div class="col-md-10 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <form action="update" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="usr">제목</label><br>
                            <input name="title" type="text" class="form-control" value="{{$member['title']}}" required>
                        </div><br>

                        <div class="form-group">
                            내용<br>
                            <textarea name="content" id="ir1" class="form-control" cols="30" rows="10" style="width:700px; height:350px;" placeholder="content" required>{{$member['content']}}</textarea>
                        </div>
                         <br>

                        <input type="hidden" value="{{$member['id']}}" name="id">
                        <input type="hidden" value="{{$member['writer']}}" name="writer">
                        <div>
                            <br>
                            <div class="card-footer">
                                <div class="form-group">
                                    <button type="submit" id="save" class="btn btn-primary">글수정</button>
                                    <input type="button" value="글목록" class="btn btn-danger" onClick="location.href='board'">
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
