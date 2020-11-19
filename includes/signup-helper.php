<?php

require 'controllers/signup-controller.php';

if (isset(($_POST['signup_submit']))) {
    require 'dbhandler.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $password = $_POST['password'];
    $passwordConfirmation = $_POST['confirm_password'];

    if($password !== $passwordConfirmation){
        header("Location: ../signup.php?error=diffPasswords");
        exit();
    }

    $signupController->register($username, $email, $password, $firstName, $lastName);
}
else{
    header("Location: ../signup.php");
    exit();
}

?>