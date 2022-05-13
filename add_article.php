<?php require_once 'logique.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="./assets/css/add_article.css">
    <title>Add Article</title>
</head>
<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
            <div class="block p-20  form-container">
                <h1>Add Article</h1>
                <form action="./add_article.php" method="post">
                    <div class="form-control">
                        <label for="title">Title *</label>
                        <input type="text" name="title" id="title" value="<?= $title ?? '' ?>">
                        <span class="text-danger"><?= $error['title'] ?></span>
                    </div>
                    <div class="form-control">
                        <label for="image">Image</label>
                        <input type="text" name="image" id="image" value="<?=  $image ?? ''?>">
                        <span class="text-danger"><?= $error['image'] ?></span>
                    </div>
                    <div class="form-control">
                        <label for="category">Category</label>
                        <select name="category" id="category">                        
                            <option value="php">PHP</option>
                            <option value="laravel">Laravel</option>
                            <option value="js">JavaScript</option>
                            <option value="css">CSS</option>
                            <option value="html">HTML</option>
                        </select>
                        <span class="text-danger"><?= $error['category'] ?></span>
                    </div>
                    <div class="form-control">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" value="<?= $content ?? '' ?>"></textarea>
                        <span class="text-danger"><?= $error['content'] ?></span>
                    </div>
                    <div class="form-action">
                        <a href="./index.php" class="btn btn-sacondary" >Cancer</a>
                        <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
       <?php require_once 'includes/footer.php' ?>
    </div>
</body>
</html>