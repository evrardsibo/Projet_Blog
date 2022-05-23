<?php require_once './auth-login-logique.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="./assets/css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
            <div class="block p-20  form-container">
                    <h1>Login</h1>
                    <form action="./auth-login.php" method="post">
                        <div class="form-control">
                            <label for="email">Email *</label>
                            <input type="text" name="email" id="email" value="<?=  $email ?? ''?>">
                            <span class="text-danger"><?= $error['email'] ?></span>
                        </div>
                        <div class="form-control">
                            <label for="password">Password *</label>
                            <input type="password" name="password" id="password">
                            <span class="text-danger"><?= $error['password'] ?></span>
                        </div>
                        <div class="form-action">
                            <a href="./auth-register.php" class="btn btn-secondary" >Register</a>
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                    </form>
            </div> 
        </div>
       <?php require_once 'includes/footer.php' ?>
    </div>
</body>
</html>