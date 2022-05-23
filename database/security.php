<?php 

       //$pdo = require './database/database.php';  
        class AuthDb
        {
            private PDOStatement $statemantRegister;
            public function __construct(private PDO $pdo)
            {
                $this->statemantRegister = $pdo->prepare("INSERT INTO user VALUES (
                    DEFAULT,
                    :firstname,
                    :lastname,
                    :email,
                    :password
                )");   
            }

            public function Login(array $credential): void
            {

            }

            public function Register(array $user): void
            {
                $passwordhash = password_hash($user['password'], PASSWORD_BCRYPT );
                $this->statemantRegister->bindValue(':firstname', $user['firstname']);
                $this->statemantRegister->bindValue(':lastname', $user['lastname']);
                $this->statemantRegister->bindValue(':email', $user['email']);
                $this->statemantRegister->bindValue(':password', $passwordhash);
                $this->statemantRegister->execute();
                return;
            }

            public function Logout(): void
            {

            }

            // public function IsLogin(): array | false
            // {

            // }
        }

        return new AuthDb($pdo);
        // function isLogin()
        // {
        //     $pdo = require __DIR__ . './database.php';
        //     $sessionID = $_COOKIE['evr'] ?? '';
        //     //echo $sessionID;

        //     if($sessionID)
        //     {
        //         $statementSession = $pdo->prepare("SELECT * FROM session WHERE idsession=:idsession");
        //         $statementSession->bindValue(':idsession', $sessionID);
        //         $statementSession->execute();
        //         $session = $statementSession->fetch();
        //         //print_r($session);

        //             if($session)
        //             {
        //                 $statementUser = $pdo->prepare("SELECT * FROM user WHERE iduser=:iduser");
        //                 $statementUser->bindValue('iduser', $session['user_id']);
        //                 $statementUser->execute();
        //                 $user = $statementUser->fetch();
        //                 //print_r($user);
        //             }
        //     }

        //     return $user ?? false;
            

        // };
        //echo isLogin();