<!-- Modal -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">수정하기</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="update.php" method="POST">
        <div class="modal-body">
          title : <input type="text" id="title_update" name="title_update" class="form-control" value="" placeholder="제목 입력" required>
          url : <input type="text" id="url_update" name="url_update" class="form-control" value="" placeholder="URL 입력" required>
          <input type="hidden" name="id_update" id="id_update" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">수정</button>
        </div>
      </form>
    </div>
  </div>
</div> 

<script>
  $(function(){
    $(".edit_data").click(function(){
      var edit_id = $(this).attr("id");
      $.ajax({
        url: "edit.php",
        method:"POST",
        data:{id:edit_id},
        dataType:"json",
        success:function(data){
          $('#title_update').val(data.response.result[0].title);
          $('#url_update').val(data.response.result[0].url);
          $('#id_update').val(data.response.result[0].id);
          $('#modal_edit').modal('show');
          console.log(data);
        },
        error:function(request, status, error){
          console.log("code = "+ request.status + " message = " + request.responseText + " error = " + error);
        }
      });
    });

    // // update (여기서부터 시작)
    // $.ajax({  
    //   url:"insert.php",  
    //   method:"POST",  
    //   data:$('#insert_form').serialize(),  
    //   beforeSend:function(){  
    //     $('#insert').val("Inserting");  
    //   },  
    //   success:function(data){  
    //     $('#insert_form')[0].reset();  
    //     $('#add_data_Modal').modal('hide');  
    //     console.log(data);  
    //   }  
    // }); 
  });
</script>