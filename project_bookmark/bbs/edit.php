<?php
  require_once("db.php");
  require_once("../tools.php");
  if(isset($_POST["id"])){
    $sql = "SELECT * FROM myboards WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(":id", $_POST["id"], PDO::PARAM_STR);
    $statement->execute();
    
    $record_cnt = 0;
    $record_array = [];
 
    while($board = $statement->fetch(PDO::FETCH_ASSOC)){
      array_push($record_array, array("id"=>$board["id"], "title" => $board['title'], "url" =>$board['url']));
      $record_cnt++;
    }

    $json_result = [
      "status" => 200,
      "response" => [
        "result" => $record_array
      ]
    ];

    echo json_encode($json_result);
    //$json = json_encode($board);
    //okgo("성공", "main.php");
  }
?>