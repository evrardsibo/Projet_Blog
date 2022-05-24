<?php 

    require './database/database.php';
    $authModel = require_once __DIR__ .'./database/security.php';
    $sessionId = $_COOKIE['evr'];
    if($sessionId)
    {
       $authModel->Logout($sessionId);

        header('Location: ./index.php');
    }