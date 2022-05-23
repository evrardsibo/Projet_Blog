<?php require_once __DIR__ . './profile-logique.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="./assets/css/profile.css">
    <title>Profile</title>
</head>
<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
            <h1>My Space</h1>
            <h2>My Inforamtion</h2>
            <div class="info-container">
                <ul>
                    <li>
                        <strong>Firstname :</strong>
                        <p><?= $currentuser['firstname'] ?></p>
                    </li>
                    <li>
                        <strong>Lastname :</strong>
                        <p><?= $currentuser['lastname'] ?></p>
                    </li>
                    <li>
                        <strong>Email :</strong>
                        <p><?= $currentuser['email'] ?></p>
                    </li>
                </ul>
            </div>
            <h2>My Articles</h2>
            <div class="articles-list">
                <ul>
                  <?php foreach($articles as $a) : ?>
                    <li>
                        <span><?= $a['title'] ?></span>
                        <div class="articles-action">
                            <a href="./form_article.php?id=<?= $a['idarticles']?>" class="btn btn-primary btn-small">Edit</a>
                            <a href="./delete-article.php?id=<?= $a['idarticles']?>" class="btn btn-danger btn-small">Delete</a>
                        </div>
                    </li>
                  <?php endforeach; ?>    
                </ul>
            </div>
        </div>
       <?php require_once 'includes/footer.php' ?>
    </div>
</body>
</html>