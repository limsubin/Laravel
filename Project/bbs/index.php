<?php
  require_once("db.php");
  $sql = 'SELECT * FROM myboards ORDER BY id DESC';
  $statement = $connection->prepare($sql);
  $statement->execute();
  $boards = $statement->fetchAll(PDO::FETCH_OBJ);
?>