<?php 

    $filename = __DIR__ . './data.json';
    $articles = json_decode(file_get_contents($filename), true);
    print_r($articles);
    $dsn = 'mysql:host=localhost;dbname=pblog';
    $username = 'root';
    $pwd = '';

    try {
        $pdo = new PDO($dsn, $username, $pwd,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        //echo 'ok';
    } catch (Exception $e) {
        echo 'error:' . $e->getMessage();
    }

    //$title = $articles['title'];

    $statement = $pdo->prepare("INSERT INTO articles (
        title,
        image,
        category,
        content
    ) VALUES (
        :title,
        :image,
        :category,
        :content

    )");

    foreach($articles as $article)
    {
      $statement->bindValue(':title', $article['title'], PDO::PARAM_STR);
      $statement->bindValue(':image', $article['image'], PDO::PARAM_STR);
      $statement->bindValue(':category', $article['category'], PDO::PARAM_STR);
      $statement->bindValue(':content', $article['content'], PDO::PARAM_STR);
      $statement->execute();
    }

    
