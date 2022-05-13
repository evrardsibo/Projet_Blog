<?php 
 
    const ERROR_FIELDS = 'This field is required ';
    const ERROR_LENGTH = 'Title is too short min 5 character';
    const ERROR_CONTENT = 'Content is too short min 50 character';
    const ERROR_IMAGE ='Image must be URL valide!';
    $filename = __DIR__ . './data/data.json';
    // echo '<pre>'; 
    // print_r($_SERVER);
    // echo '</pre>';

    $error = [
        'title' => '',
        'image' => '',
        'category' => '',
        'content' => '',
    ];
    $articles = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(file_exists($filename))
        {
            $articles = json_decode(file_get_contents($filename), true) ?? [];
        }
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
        {
            $articles = [...$articles, [
                'id' => time(),
                'title' => $title,
                'image' => $image,
                'category' => $category,
                'content' => $content
            ]];
            file_put_contents($filename, json_encode($articles));
            header('Location: ./index.php');
        }
    }
    