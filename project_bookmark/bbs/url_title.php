<?php
//header("Content-Type: application/json");

//function get_title(){
//if(isset($_POST["url"])){
  // $url = $_POST["main_url"];
  // $str = file_get_contents($url);
  // if(strlen($str)>0){
  //   $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
  //   preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
  //   echo json_encode($title[1]);
  // }
 // echo json_encode(["title"=>"php 들어옴"]);
//}

//}

require_once("db.php");
require_once("../tools.php");
if(isset($_POST["url"])){
  $sql = "SELECT * FROM myboards WHERE id = :id";
  $statement = $connection->prepare($sql);
  $statement->bindValue(":id", $_POST["url"], PDO::PARAM_STR);
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