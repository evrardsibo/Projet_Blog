<?php require_once './show-logique.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="./assets/css/show_article.css">
    <title>Article</title>
</head>
<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
            <div class="article-container">
                <a class="article-back" href="./">Return to article</a>
                <div class="artcile-cover-img" style="background-image:url(<?= $article['image'] ?>) ;"></div>
                <h1 class="article-title"><?= $article['title'] ?></h1>
                <div class="separator">
                    <p class="article-content"><?= $article['content'] ?></p>
                    <div class="action">
                        <a class="btn btn-danger" href="./delete-article.php?id=<?= $article['id'] ?>">Delete</a>
                        <a class="btn btn-primary" href="./form_article.php?id=<?= $article['id'] ?>">Update</a>
                    </div>
                </div>
            </div>
        </div>
       <?php require_once 'includes/footer.php' ?>
    </div>
</body>
</html>