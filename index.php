<?php 
        require_once 'logique1.php'; 
          require_once __DIR__ . './database/security.php';
          //$currentuser = isLogin();                       
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="./assets/css/index.css">
    <title>Blog</title>
</head>
<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
            <div class="newsfeed-container">
                <ul class="category_container">
                    <li class=<?= $selectedCat ? '' : 'cat-active' ?>><a href="./">All articles <span class="small">(<?= count($articles) ?>)</span></a></li>
                    <?php foreach($categories as $catname => $catnum) : ?>
                        <li class=<?= $selectedCat === $catname ? 'cat-active' : '' ?>><a href="./?cat=<?= $catname ?>"><?= $catname ?><span class="small">(<?= $catnum ?>)</span></a></li>
                    <?php endforeach; ?>
                </ul>
                <div class="newsfeed-content">
                    <?php if(!$selectedCat) : ?>
                        <?php foreach($categories as $key => $num) : ?>
                        <h2><?= $key ?></h2>
                        <div class="articles-container">
                            <?php foreach($articlePercategories[$key] as $a) : ?>
                                <a href="./show-aticle.php?id=<?= $a['idarticles'] ?>" class="article block">
                                    <div class="overflow">
                                        <div class="img-container" style="background-image:url(<?= $a['image'] ?>) ;"></div>
                                    </div>
                                    <h2><?= $a['title'] ?></h2>
                                    <?php if($a['author']) : ?>
                                        <div class="author">
                                            <p><?= $a['firstname'] . ' ' . $a['lastname'] ?></p>
                                        </div>
                                    <?php endif; ?>    
                                </a>
                            <?php endforeach; ?>    
                        </div>
                    <?php endforeach; ?>  
                    <?php else : ?>
                        <h2><?= $selectedCat ?></h2>
                        <div class="articles-container">
                            <?php foreach($articlePercategories[$selectedCat] as $a) : ?>
                                <a href="./show-aticle.php?id=<?= $a['idarticles'] ?> class="article block">
                                    <div class="overflow">
                                        <div class="img-container" style="background-image:url(<?= $a['image'] ?>) ;"></div>
                                    </div>
                                    <h2><?= $a['title'] ?></h2>
                                </a>
                            <?php endforeach; ?>    
                        </div>
                    <?php endif; ?>  
                </div>
            </div>
        </div>
       <?php require_once 'includes/footer.php' ?>
    </div>
</body>
</html>