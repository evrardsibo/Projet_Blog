<?php 
 
    $pdo = require './database/database.php';
    $authDb = require_once './database/security.php';
    const ERROR_FIELDS = 'This field is required ';
    const ERROR_FIRSTNAME = 'Firstname is too short min 5 character';
    const ERROR_LASTNAME = 'Lastname is too short min 5 character';
    const ERROR_EMAIL = 'Email is not valide !';
    const ERROR_PASSWORD = 'Password is too short min 8 character';
    const ERROR_PASSWORDCONFIRM ='This password not match';
    //print_r($authDb);
    //exit;
    //$filename = __DIR__ . './data/data.json';
    // echo '<pre>'; 
    // print_r($_SERVER);
    // echo '</pre>';

    $error = [
        'firstname' => '',
        'lastname' => '',
        'email' => '',
        'password' => '',
        'confirm_password' => ''
    ];

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        $input = filter_input_array(INPUT_POST,[
            'firstname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'lastname' => FILTER_SANITIZE_SPECIAL_CHARS,
            'email' => FILTER_SANITIZE_EMAIL,
        ]);
        $firstname = $input['firstname'] ?? '';
        $lastname = $input['lastname'] ?? '';
        $email = $input['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        


        if(!$firstname)
        {
            $error['firstname'] = ERROR_FIELDS;
        }elseif(mb_strlen($firstname) < 3)
        {
            $error['firstname'] = ERROR_FIRSTNAME;
        }

        if(!$lastname)
        {
            $error['lastname'] = ERROR_FIELDS;
        }elseif(mb_strlen($lastname) < 3)
        {
            $error['lastname'] = ERROR_LASTNAME;
        }

        if(!$email)
        {
            $error['email'] = ERROR_FIELDS;
        }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error['email'] = ERROR_EMAIL;
        }

        if(empty( $password))
        {
            $error['password'] = ERROR_FIELDS;
        }elseif(mb_strlen($password)< 8)
        {
            $error['password'] = ERROR_PASSWORD;
        }

        if(!$confirm_password)
        {
            $error['confirm_password'] = ERROR_FIELDS;
        }elseif($password !== $confirm_password)
        {
            $error['confirm_password'] = ERROR_PASSWORDCONFIRM;
        }

        if(!count(array_filter($error, fn($e) => $e !== '')))
        { 
           $authDb->register([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password
           ]);

            header('Location: ./auth-login.php');
        }
    }
    
