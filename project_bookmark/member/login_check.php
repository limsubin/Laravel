<?php
    session_start();
    require_once("../bbs/db.php");
    require_once("../tools.php");

    $id = $_POST["m_id"];
    $pw = $_POST["m_pw"];

    $sql = "SELECT * FROM member WHERE m_id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(":id", $id, PDO::PARAM_STR);
    $statement->execute();
    $member = $statement->fetch(PDO::FETCH_ASSOC);
    

    if($member["m_id"] == $id){//여기서부터 고치기
        // 로그인 성공
		// 세센에 로그인 성공 정보를 기록 : 어떻게?
		$_SESSION["uid"] = $id;
		$_SESSION["name"] = $member["m_name"];
        okgo("로그인 성공: ", "../bbs/main.php");
    }else{
        okgo("로그인 실패", "../bbs/main.php");
    }
?>