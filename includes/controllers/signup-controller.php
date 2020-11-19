<?php

class SignupController {
    const USER_ID_FIELD = "userId";
    const USERNAME_FIELD = "username";
    const EMAIL_FIELD = "email";
    const PASSWORD_FIELD = "password";
    const FIRST_NAME_FIELD = "firstName";
    const LAST_NAME_FIELD = "lastName";

    function register($username, $email, $password, $firstName, $lastName) {
        require 'sql-helper.php';

        $usernameExists = queryPrepared("SELECT * FROM users WHERE ".self::USERNAME_FIELD."=? OR ".self::EMAIL_FIELD."=?", "ss", $username, $email);

        if (!empty($usernameExists)) {
            throw new RegistrationFailedException("Username or email is already in use.");
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $rowsAffected = executePrepared("INSERT INTO users (".self::USERNAME_FIELD.", ".self::EMAIL_FIELD.", ".self::FIRST_NAME_FIELD.", ".self::LAST_NAME_FIELD.", ".self::PASSWORD_FIELD.") VALUES (?,?,?,?,?)", "sssss", $username, $email, $firstName, $lastName, $hashedPassword);
        $userId = queryPrepared("SELECT ".self::USER_ID_FIELD." FROM users WHERE ".self::USERNAME_FIELD."=? AND ".self::EMAIL_FIELD."=?", "ss", $username, $email);

        session_start();
        $_SESSION[self::USER_ID_FIELD] = $userId[self::USER_ID_FIELD];
        $_SESSION[self::USERNAME_FIELD] = $username;
        $_SESSION[self::FIRST_NAME_FIELD] = $firstName;
        $_SESSION[self::LAST_NAME_FIELD] = $lastName;
    }

    function isUsernameInUse($username) {
        require 'dbhandler.php';
        require 'exceptions.php';

        $usernameExists = queryPrepared("SELECT * FROM users WHERE ".self::USERNAME_FIELD."=?", "s", $username);

        return !empty($usernameExists);
    }
}

$signupController = new SignupController;

?>