<?php
    $dsn = 'mysql:host=localhost;dbname=project';
    $username = 'root';
    $password = '0728';
    $options =[];

    try {
        $connection = new PDO($dsn, $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        exit($e->getMessage());
    }

    
?>