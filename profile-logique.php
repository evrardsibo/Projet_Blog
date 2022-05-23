<?php 

    require_once __DIR__ . './database/security.php';
    $dbmodel = require_once __DIR__ . './database/models/dbModel.php';
    $articles = [];
    $currentuser = isLogin();

    if(!$currentuser)
    {
        header('Location: ./index.php');
    }

    $articles = $dbmodel->fetchUserArticle($currentuser['iduser']);

    //var_dump($articles);
    //exit;