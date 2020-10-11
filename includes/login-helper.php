<?php

if (isset(($_POST['login-submit']))) {
    require 'dbhandler.php';

    $username = $_POST['email'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];

    if (empty($username) || empty($password)) {
        header("Location: ../login.php?error=EmptyField");
        exit();
    }

    $sql = "SELECT * FROM users WHERE uname=? OR email=?";
    $statement = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("Location: ../login.php?error=SQLInjection");
        exit();
    } else {
        $statement->bind_param("ss", $username, $username);
        $statement->execute();
        $result = $statement->get_result();
        $data = $result->fetch_assoc();

        if (empty($data)) {
            header("Location: ../login.php?error=UserNotFound");
            exit();
        }

        $correctPassword = password_verify($password, $data['password']);

        if ($correctPassword) {
            session_start();
            $_SESSION['uid'] = $data['uid'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['fname'] = $data['fname'];
            $_SESSION['lname'] = $data['lname'];
            header("Location: ../profile.php?login=success");
            exit();
        } else {
            header("Location: ../login.php?error=WrongPass");
            exit();
        }
    }

    mysqli_stmt_close($statement);
    mysql_close($conn);
} else {
    header("Location: ../login.php");
    exit();
}

?>