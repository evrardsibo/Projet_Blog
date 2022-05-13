       <!-- <pre>
           <?php 
            // print_r($_SERVER);
           ?>
       </pre> -->
       <header>
            <a href="./index.php" class="logo">Evrard Blog</a>
            <ul class="header-menu">
                <li class="<?= $_SERVER['REQUEST_URI'] === '/Projet_Blog/add_article.php' ? 'active': '' ?> ">
                    <a href="./add_article.php">Add Article</a>
                </li>
            </ul>
        </header>