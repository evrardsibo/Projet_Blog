<?php $currentuser = $currentuser ?? false; ?>
      <header>
            <a href="./index.php" class="logo">Evrard Blog</a>
            <div class="header-mobile">
                <div class="header-mobile-icon">
                    <img src="./assets/images/mobile-menu.png" alt="icon-menu">
                </div>
                <ul class="header-mobile-list">
                <?php if ($currentuser): ?>
                    <li class=<?= $_SERVER['REQUEST_URI'] === './projet_blog/form_article.php' ? 'active' : '' ?>>
                        <a href="./form_article.php">Add Article</a>
                    </li>
                    <li class="<?= $_SERVER['REQUEST_URI'] === './projet_blog/profile.php' ? 'active' : '' ?>">
                        <a href="./profile.php">Profile</a>
                    </li>
                    <li>
                    <a href="./auth-logout.php">Logout</a>
                    </li>
                 <?php else: ?>
                    <li class=<?= $_SERVER['REQUEST_URI'] === './Projet_Blog/auth-register.php' ? 'active' : '' ?>>
                        <a href="./auth-register.php">Register</a>
                    </li>
                    <li class=<?= $_SERVER['REQUEST_URI'] === './projet_blog/auth-login.php' ? 'active' : '' ?>>
                        <a href="./auth-login.php">Login</a>
                    </li>
                 <?php endif; ?>    
            </ul>
            </div>
            <ul class="header-menu">
                <?php if ($currentuser): ?>
                    <li class=<?= $_SERVER['REQUEST_URI'] === './projet_blog/form_article.php' ? 'active' : '' ?>>
                        <a href="./form_article.php">Add Article</a>
                    </li>
                    <li class="<?= $_SERVER['REQUEST_URI'] === './projet_blog/profile.php' ? 'active' : '' ?> header-profile">
                        <a href="./profile.php"><?= $currentuser['firstname'][0] . $currentuser['lastname'][0] ?></a>
                    </li>
                    <li>
                    <a href="./auth-logout.php">Logout</a>
                    </li>
                 <?php else: ?>
                    <li class=<?= $_SERVER['REQUEST_URI'] === './Projet_Blog/auth-register.php' ? 'active' : '' ?>>
                        <a href="./auth-register.php">Register</a>
                    </li>
                    <li class=<?= $_SERVER['REQUEST_URI'] === './projet_blog/auth-login.php' ? 'active' : '' ?>>
                        <a href="./auth-login.php">Login</a>
                    </li>
                 <?php endif; ?>    
            </ul>
        </header>
 
                    
                    
                    