<?php

require 'controllers/signup-controller.php';

if (isset(($_POST['login-submit']))) {
    $username = $_POST['email'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];

    if(empty($username) || empty($password)){
        header("Location: ../login.php?error=EmptyField");
        exit();
    }

    try {
        $loginController->login($username, $password);    
        header("Location: ../profile.php?login=Success");
        exit();   
    }
    catch (Exception $e) {
        header("Location: ../login.php?error=WrongPass");
        exit();
    }
}
else {
    header("Location: ../login.php");
    exit();
}

?>