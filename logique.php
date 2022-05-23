<?php 
 
    $dbModel = require_once './database/models/dbModel.php';
    require_once __DIR__ . './database/security.php';
    $currentuser = isLogin();
    //print_r($currentuser);
    if(!$currentuser)
    {
        header('Location: ./index.php');
    }
    const ERROR_FIELDS = 'This field is required ';
    const ERROR_LENGTH = 'Title is too short min 5 character';
    const ERROR_CONTENT = 'Content is too short min 50 character';
    const ERROR_IMAGE ='Image must be URL valide!';
    //$filename = __DIR__ . './data/data.json';
    // echo '<pre>'; 
    // print_r($_SERVER);
    // echo '</pre>';

    $error = [
        'title' => '',
        'image' => '',
        'category' => '',
        'content' => '',
    ];
    $category = '';

    // if(file_exists($filename))
    // {
    //     $articles = json_decode(file_get_contents($filename), true) ?? [];
    // }
    
    $_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //print_r($_GET);
    $id = $_GET['id'] ?? '';
    //print_r($id);
    if($id)
    {
        
        // $articleindex = array_search($id, array_column($articles, 'id'));
        // $article = $articles[$articleindex];
        //print_r($article);
        // $statementRead->bindValue(':idarticles', $id, PDO::PARAM_INT);
        // $statementRead->execute();
        $articles = $dbModel->fetch($id);
        if($articles['author'] !== $currentuser['iduser'])
        {
            header('Location: ./index.php');
        }
        $title = $articles['title'];
        $image = $articles['image'];
        $category = $articles['category'];
        $content = $articles['content'];
        //echo $content;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        $_POST = filter_input_array(INPUT_POST,[
            'title' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'image' => FILTER_SANITIZE_URL,
            'category' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'content' => [
                'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
            ]
        ]);
        $title = $_POST['title'] ?? '';
        $image = $_POST['image'] ?? '';
        $category = $_POST['category'] ?? '';
        $content = $_POST['content'] ?? '';

        if(!$title)
        {
            $error['title'] = ERROR_FIELDS;
        }elseif(mb_strlen($title) < 5)
        {
            $error['title'] = ERROR_CONTENT;
        }

        if(!$image)
        {
            $error['image'] = ERROR_FIELDS;
        }elseif(!filter_var($image, FILTER_VALIDATE_URL))
        {
            $error['image'] = ERROR_IMAGE;
        }

        if(!$category)
        {
            $error['category'] = ERROR_FIELDS;
        }

        if(!$content)
        {
            $error['content'] = ERROR_FIELDS;
        }elseif(mb_strlen($content) < 50)
        {
            $error['content'] = ERROR_CONTENT;
        }

        if(!count(array_filter($error, fn($e) => $e !== '')))
        {   if($id)
            {
                $articles['title'] = $title;
                $articles['image'] = $image;
                $articles['category'] = $category;
                $articles['content'] = $content;
                $articles['author'] = $currentuser['iduser'];
                $dbModel->update($articles);
                // $statementUpadte->bindValue(':title',$articles['title'], PDO::PARAM_STR);
                // $statementUpadte->bindValue(':image',$articles['image'], PDO::PARAM_STR);
                // $statementUpadte->bindValue(':category',$articles['category'], PDO::PARAM_STR);
                // $statementUpadte->bindValue(':content',$articles['content'], PDO::PARAM_STR);
                // $statementUpadte->bindValue(':idarticles',$id, PDO::PARAM_INT);
                // $statementUpadte->execute();
            }else
            {

                $dbModel->create([
                    'title' => $title,
                    'image' => $image,
                    'category' => $category,
                    'content' => $content,
                    'author' => $currentuser['iduser']
                ]);
                // $articles = [...$articles, [
                //     'id' => time(),
                //     'title' => $title,
                //     'image' => $image,
                //     'category' => $category,
                //     'content' => $content
                // ]];
                // $statementCreate->bindValue(':title', $title, PDO::PARAM_STR);
                // $statementCreate->bindValue(':image', $image, PDO::PARAM_STR);
                // $statementCreate->bindValue(':category', $category, PDO::PARAM_STR);
                // $statementCreate->bindValue(':content', $content, PDO::PARAM_STR);
                // $statementCreate->execute();
            }
            //file_put_contents($filename, json_encode($articles));
            header('Location: ./index.php');
        }
    }
    
