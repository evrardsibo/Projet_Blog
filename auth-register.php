<?php require_once './auth-reg-logique.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once 'includes/head.php' ?>
    <link rel="stylesheet" href="./assets/css/register.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <?php require_once 'includes/header.php' ?>
        <div class="content">
        <div class="block p-20  form-container">
                <h1>Register</h1>
                <form action="./auth-register.php" method="post">
                    <div class="form-control">
                        <label for="firstname">First Name *</label>
                        <input type="text" name="firstname" id="firstname" value="<?= $firstname ?? '' ?>">
                        <span class="text-danger"><?= $error['firstname'] ?></span>
                    </div>
                    <div class="form-control">
                        <label for="lastname">Last Name *</label>
                        <input type="text" name="lastname" id="lastname" value="<?=  $lastname ?? ''?>">
                        <span class="text-danger"><?= $error['lastname'] ?></span>
                    </div>
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
                    <div class="form-control">
                        <label for="confirm_password">Confirm Password *</label>
                        <input type="password" name="confirm_password" id="confirm_password">
                        <span class="text-danger"><?= $error['confirm_password'] ?></span>
                    </div>
                    <div class="form-action">
                        <a href="./index.php" class="btn btn-danger" >Cancer</a>
                        <button class="btn btn-primary" type="submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
       <?php require_once 'includes/footer.php' ?>
    </div>
</body>
</html>