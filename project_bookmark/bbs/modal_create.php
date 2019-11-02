
<!-- Modal -->
<div class="modal fade" id="modal_create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">추가하기</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="create.php" method="POST">
        <div class="modal-body">
          title : <input type="text" id="title" name="title" class="form-control" value="" placeholder="제목 입력" required>
          url : <input type="text" id="url" name="url" class="form-control" value="" placeholder="URL 입력" required>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">저장</button>
        </div>
      </form>
    </div>
  </div>
</div> 



<!-- script -->
<script language='javascript'>
  $(function(){
    $("#button").click(function(){
        var modal_url = $('#url').val($('#main_url').val());
        var main_url = $(".main_url").val();
        $.ajax({
          url:"url_title.php",
          method:"POST",
          data:{url:main_url},
          dataType:"json",
          success:function(data){
            alert("성공 ,"+data);
          },
          error:function(request, status, error){
            alert("실패");
            console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
          }
        });
        //var main_title = $(document).find("title").text();
        //console.log(main_title);
        //document.write(main_title);
    });
  });
</script>