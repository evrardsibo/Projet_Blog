<?php 
    require __DIR__ . './database/database.php';
    $authModel = require_once __DIR__ . './database/security.php';
    $dbmodel = require_once __DIR__ . './database/models/dbModel.php';
    $articles = [];
    $currentuser = $authModel->isLogin();

    if(!$currentuser)
    {
        header('Location: ./index.php');
    }

    $articles = $dbmodel->fetchUserArticle($currentuser['iduser']);

    //var_dump($articles);
    //exit;