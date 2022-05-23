<?php 

    $pdo = require './database/database.php';
    $sessionId = $_COOKIE['evr'];
    if($sessionId)
    {
        $statement = $pdo->prepare("DELETE FROM session WHERE idsession = :idsession");
        $statement->bindValue(':idsession', $sessionId);
        $statement->execute();
        setcookie('evr','', time() - 1);
        header('Location: ./index.php');
    }