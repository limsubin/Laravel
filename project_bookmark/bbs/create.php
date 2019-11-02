<?php
    require_once("db.php");
    require_once("../tools.php");
    //require_once("BoardDao.php");
    
    echo $_REQUEST['title'];
    
    if(isset($_REQUEST['title']) && isset($_REQUEST['url'])){
        $title = $_REQUEST['title'];
        $url = $_REQUEST['url'];

        $sql = 'INSERT INTO myboards(title, url) VALUES(:title, :url)';
        $statement = $connection->prepare($sql);
        //$statement->bindValue(":title", $title, PDO::PARAM_STR);

        if($statement->execute([':title' => $title, ':url' => $url])){
            okGo("insert 성공", "main.php");
            //echo 'insert 성공';
        }
        

    }
?>