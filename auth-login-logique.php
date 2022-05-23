<?php 
    
    $pdo = require_once './database/database.php';
    const ERROR_FIELDS = 'This fiels is required';
    const ERROR_EMAIL = 'Email unkwon !';
    const ERROR_PASSWORD = 'Password not correct !';
    const ERROR_EMAIL_VALIDE = 'Email is not valide !';
    
    $error = [
        'email' => '',
        'password' => ''
    ];

    $input = filter_input_array(INPUT_POST, FILTER_SANITIZE_EMAIL);
    $email = $input['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if (!$email) {
            $error['email'] = ERROR_FIELDS;
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error['email'] = ERROR_EMAIL_VALIDE;
        }

        if (!$password) {
            $error['password'] = ERROR_FIELDS;
        }

        if (!array_filter($error, fn($e) => $e !== '')) {
            $statementUser = $pdo->prepare("SELECT * FROM user WHERE email=:email");
            $statementUser->bindValue(':email', $email);
            $statementUser->execute();
            $user = $statementUser->fetch();

            //echo $user;

            if (!$user) {
                $error['email'] = ERROR_EMAIL;
            }else
            {
                if(!password_verify($password, $user['password']))
                {
                    $error['email'] = ERROR_PASSWORD ;
                }else
                {
                    $stamentSession = $pdo->prepare("INSERT INTO session VALUES (
                        DEFAULT,
                        :user_id
                    )");

                    $stamentSession->bindValue(':user_id', $user['iduser']);
                    $stamentSession->execute();
                    $sessionId = $pdo->lastInsertId();
                    setcookie('evr', $sessionId, time() + 60 * 60 * 24 * 14, '', '', false, true);
                    header('Location: ./index.php');
                }
            }
        }
    }