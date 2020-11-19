<?php

class ProfileController {
    const USER_ID_FIELD = "userId";
    const USERNAME_FIELD = "username";
    const EMAIL_FIELD = "email";
    const PASSWORD_FIELD = "password";
    const FIRST_NAME_FIELD = "firstName";
    const LAST_NAME_FIELD = "lastName";
    const PROFILE_PICTURE_PATH = "picturePath";
    const BIO_FIELD = "bio";

    function updateProject($image, $bio) {
        require 'login-controller.php';

        if ($loginController->isLoggedIn()) {
            require 'upload-controller.php';

            $ext = $uploadController->getExtension($image);
            $destination = "../profiles/".uniqid('',true).".".$ext;
            
            require 'sql-helper.php';
            executePrepared("UPDATE users SET ".self::PROFILE_PICTURE_PATH."=?, ".self::BIO_FIELD."=? WHERE ".self::USER_ID_FIELD."=?", "sss", $destination, $bio, $loginController->getUserId());            
            
            $uploadController->verifyAndMoveFile($image, $destination);
        } else {
            require 'exceptions.php';
            throw new UserNotLoggedInException();
        }
    }

    function fetchProfileInfo($userId) {
        require 'sql-helper.php';
        $userData = queryPrepared("SELECT ".self::USERNAME_FIELD.", ".self::PROFILE_PICTURE_PATH.", ".self::BIO_FIELD." FROM profiles WHERE ".self::USER_ID_FIELD."=?", "s", $userId);
        return $userData;
    }

    function fetchCurrentProfileInfo() {
        require 'login-controller.php';

        if ($loginController->isLoggedIn()) {
            return fetchProfileInfo($loginController->getUserId());
        } else {
            require 'exceptions.php';
            throw new UserNotLoggedInException();
        }
    }

    function resolveProfiles($userIdList) {
        $profiles = array();

        foreach ($userIdList as $userId) {
            $profiles[$userId] = $this->fetchProfileInfo($userId);
        }

        return $profiles;
    }
}

$profileController = new ProfileController;

?>