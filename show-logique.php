<?php 
 $dbModel = require_once './database/models/dbModel.php';
//  $filename = __DIR__ . './data/data.json';
//  $articles = [];
 $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 $id = $_GET['id'];
 //$statement =  $pdo->prepare("SELECT * FROM articles WHERE idarticles = :idarticles");

 if(!$id)
 {
     header('Location: ./');
 }else
 {
    // $statement->bindValue(':idarticles', $id, PDO::PARAM_INT);
    // $statement->execute();
    //$article = $statement->fetch();
        $article = $dbModel->fetch($id);

    //  if(file_exists($filename))
    //  {
    //      $articles = json_decode(file_get_contents($filename), true) ?? [];
    //      $articleIndex = array_search($id, array_column($articles, 'id'));
    //      $article = $articles[$articleIndex];
    //      //print_r($article);
    
    //  }
 }
