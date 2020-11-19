<?php

class LoginController {
    const USER_ID_FIELD = "userId";
    const USERNAME_FIELD = "username";
    const EMAIL_FIELD = "email";
    const PASSWORD_FIELD = "password";
    const FIRST_NAME_FIELD = "firstName";
    const LAST_NAME_FIELD = "lastName";

    function login($username, $password) {
        require 'sql-helper.php';

        $userData = queryPrepared("SELECT * FROM users WHERE ".self::USERNAME_FIELD."=? OR ".self::EMAIL_FIELD."=?", "ss", $username, $username);

        if (empty($userData)) {
            throw new LoginFailedException("Login failed.");
        }

        if (password_verify($password, $userData[self::PASSWORD_FIELD])) {
            session_start();

            $_SESSION[self::USER_ID_FIELD] = $userData[self::USER_ID_FIELD];
            $_SESSION[self::USERNAME_FIELD] = $userData[self::USERNAME_FIELD];
            $_SESSION[self::FIRST_NAME_FIELD] = $userData[self::FIRST_NAME_FIELD];
            $_SESSION[self::LAST_NAME_FIELD] = $userData[self::LAST_NAME_FIELD];
        }
    }

    function logout() {
        session_start();
        session_unset();
        session_destroy();
    }

    function isLoggedIn() {
        return isset($_SESSION[self::USER_ID_FIELD]);
    }

    function getUserId() {
        return $_SESSION[self::USER_ID_FIELD];
    }
}

$loginController = new LoginController;

?>