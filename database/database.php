<?php 
    
    $dsn = 'mysql:host=localhost;dbname=pblog';
    $username = 'root';
    $pwd = '';

    try {
        $pdo = new PDO($dsn, $username, $pwd,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        //echo 'ok';
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }

    return $pdo;