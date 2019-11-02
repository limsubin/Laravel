<?php 
  require_once("db.php");
  require_once("../tools.php");

  if(isset($_POST["title_update"]) && isset($_POST["url_update"])){
    $title = $_POST["title_update"];
    $url = $_POST["url_update"];
    $id = $_POST["id_update"];
    
    $sql = "UPDATE myboards SET title=:title, url=:url WHERE id=:id";
    $statement = $connection->prepare($sql);
    if($statement->execute([':title' => $title, ':url' => $url, ':id' => $id])){
      okgo("update 성공", "main.php");
    }
  }
?>