<?php 
  //  $filename = __DIR__ . './data/data.json';
  //  $articles = [];
  $dbModel = require_once './database/models/dbModel.php';
  $authModel =require_once __DIR__ . './database/security.php';
  $currentUser = $authModel->isLogin();
  if($currentUser)
  {

    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = $_GET['id'] ?? '';
   
    if ($id) {
     //header('Location: ./index.php');!
       // $statementDelete->bindvalue(':idarticles', $id);
       // $statementDelete->execute();
       $article = $dbModel->fetch($id);

       if($article['author'] === $currentUser['iduser'])
       {

         $dbModel->delete($id);
       }
   }// else {
     // if (file_exists($filename)) {
       // $articles = json_decode(file_get_contents($filename), true) ?? [];
       // $articleIndex = array_search($id, array_column($articles, 'id'));
       // array_splice($articles, $articleIndex, 1);
       // file_put_contents($filename, json_encode($articles));
       
       //}
       //}
      }
      header('Location: ./index.php');