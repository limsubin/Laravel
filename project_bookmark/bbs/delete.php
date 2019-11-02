<?php
  require_once("db.php");
  require_once("../tools.php");
  $id = $_GET['id'];
  $sql = "DELETE FROM myboards WHERE id=:id";
  $statement = $connection->prepare($sql);
  if($statement->execute([":id"=>$id])){
    okgo("삭제 성공","main.php");
    //header("Location: /");
  }
?>