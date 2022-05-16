<?php 
    require_once 'logique.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="./assets/css/form_article.css">
    <title><?= $id ? 'Edit' : 'Add' ?> Article</title>
</head>
<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
            <div class="block p-20  form-container">
                <h1><?= $id ? 'Edit' : 'Add' ?> Article</h1>
                <form action="./form_article.php<?= $id ? "?id=$id" : ''?>" method="post">
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
                            <option <?=!$category || $category === 'php' ? 'selected' : '' ?>></option> value="php">PHP</option>
                            <option <?= $category === 'laravel' ? 'selected' : '' ?> value="laravel">Laravel</option>
                            <option <?= $category === 'js' ? 'selected' : '' ?> value="js">JavaScript</option>
                            <option <?= $category === 'css' ? 'selected' : '' ?> value="css">CSS</option>
                            <option <?= $category === 'html' ? 'selected' : '' ?> value="html">HTML</option>
                        </select>
                        <span class="text-danger"><?= $error['category'] ?></span>
                    </div>
                    <div class="form-control">
                        <label for="content">Content</label>
                        <textarea name="content" id="content" value=""><?= $content ?? '' ?></textarea>
                        <span class="text-danger"><?= $error['content'] ?></span>
                    </div>
                    <div class="form-action">
                        <a href="./index.php" class="btn btn-danger" >Cancer</a>
                        <button class="btn btn-primary" type="submit"><?= $id ? 'Update' : 'Send' ?></button>
                    </div>
                </form>
            </div>
        </div>
       <?php require_once 'includes/footer.php' ?>
    </div>
</body>
</html>