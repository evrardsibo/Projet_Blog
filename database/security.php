<?php 

       //$pdo = require './database/database.php';  
        class AuthDb
        {
            private PDOStatement $statemantRegister;
            private PDOStatement $statementSession;
            private PDOStatement $statementUser;
            private PDOStatement $statementUserEmail;
            private PDOStatement $statementLogin;
            private PDOStatement $statementLogout;
            public function __construct(private PDO $pdo)
            {
                $this->statemantRegister = $pdo->prepare("INSERT INTO user VALUES (
                    DEFAULT,
                    :firstname,
                    :lastname,
                    :email,
                    :password
                )"); 
                
                $this->statementSession = $pdo->prepare("SELECT * FROM session WHERE idsession=:idsession");

                $this->statementUser = $pdo->prepare("SELECT * FROM user WHERE iduser=:iduser");

                $this->statementUserEmail = $pdo->prepare("SELECT * FROM user WHERE email=:email");

                $this->statementLogin = $pdo->prepare("INSERT INTO session VALUES (
                    :idsession,
                    :user_id
                )");

                $this->statementLogout = $pdo->prepare("DELETE FROM session WHERE idsession = :idsession");
            }

            public function Login(string $userId): void
            {
                $sessionId = bin2hex(random_bytes(32));
                $this->statementLogin->bindValue(':idsession', $sessionId);
                $this->statementLogin->bindValue(':user_id', $userId);
                $this->statementLogin->execute();
                $signature = hash_hmac('sha256', $sessionId, 'murahumbasha');
                setcookie('evr', $sessionId, time() + 60 * 60 * 24 * 14, '', '', false, true);
                setcookie('signature', $signature, time() + 60 * 60 * 24 * 14, '', '', false, true);
                return;
            }

            public function getEmailFromUser(string $email): array
            {
                $this->statementUserEmail->bindValue(':email', $email);
                $this->statementUserEmail->execute();
                return $this->statementUserEmail->fetch();
                 
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

            public function Logout(string $sessionId): void
            {
                $this->statementLogout->bindValue(':idsession', $sessionId);
                $this->statementLogout->execute();
                setcookie('evr','', time() - 1);
                setcookie('signature','', time() - 1);
                return;
            }

            public function IsLogin(): array | false
            {
                
                    $sessionID = $_COOKIE['evr'] ?? '';
                    $signature= $_COOKIE['signature'] ?? '';
                    //echo $sessionID;
        
                    if($sessionID && $signature)
                    {
                        $hash = hash_hmac('sha256', $sessionID, 'murahumbasha');
                        if(hash_equals($hash, $signature))
                        {

                            $this->statementSession->bindValue(':idsession', $sessionID);
                            $this->statementSession->execute();
                            $session = $this->statementSession->fetch();
                            //print_r($session);
            
                                if($session)
                                {
                                    
                                    $this->statementUser->bindValue('iduser', $session['user_id']);
                                    $this->statementUser->execute();
                                    $user = $this->statementUser->fetch();
                                    //print_r($user);
                                }
                        }
                    }
                    return $user ?? false;
            }
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