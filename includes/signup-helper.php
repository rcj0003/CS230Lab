<?php

if (isset(($_POST['signup_submit']))) {
    require 'dbhandler.php';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $password = $_POST['password'];
    $passwordConfirmation = $_POST['confirm_password'];

    if ($password != $passwordConfirmation) {
        header("Location: ../signup.php?error=diffPasswords&first_name=".$firstName."&last_name=".$lastName."&username=".$username);
        exit();
    } else {
        $sql = "SELECT uname FROM users WHERE uname=?";
        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("Location: ../signup.php?error=SQLInjection&first_name=".$firstName."&last_name=".$lastName."&username=".$username);
            exit();
        } else {
            mysqli_stmt_bind_param($statement, "s", $username);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement);
            $check = mysqli_stmt_num_rows($statement);

            if ($check > 0) {
                header("Location: ../signup.php?error=UsernameTaken&first_name=".$firstName."&last_name=".$lastName);
                exit();
            }

            $sql = "SELECT email FROM users WHERE email=?";
            $statement = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($statement, $sql)) {
                header("Location: ../signup.php?error=SQLInjection&first_name=".$firstName."&last_name=".$lastName."&username=".$username);
                exit();
            } else {
                mysqli_stmt_bind_param($statement, "s", $email);
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
                $check = mysqli_stmt_num_rows($statement);
    
                if ($check > 0) {
                    header("Location: ../signup.php?error=EmailInUse&first_name=".$firstName."&last_name=".$lastName."&username=".$username);
                    exit();
                }

                $sql = "INSERT INTO users (uname, email, fname, lname, password) VALUES (?,?,?,?,?)";
                $statement = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($statement, $sql)) {
                    header("Location: ../signup.php?error=SQLInjection&first_name=".$firstName."&last_name=".$lastName."&username=".$username);
                    exit();
                } else {
                    $hashedPassword = password_hash(password, PASSWORD_BCRYPT);

                    mysqli_stmt_bind_param($statement, "sssss", $username, $email, $firstName, $lastName, $hashedPassword);
                    mysqli_stmt_execute($statement);
                    mysqli_stmt_store_result($statement);

                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }

        mysqli_stmt_close($statement);
        mysql_close($conn);
    }
} else {
    header("Location: ../signup.php");
    exit();
}

?>