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

    function updateProfile($image, $bio) {
        require_once 'login-controller.php';

        $loginController = new LoginController;

        if ($loginController->isLoggedIn()) {
            require_once 'upload-controller.php';

            $uploadController = new UploadController;

            $ext = $uploadController->getFileExtension($image);
            $destination = "../uploads/".uniqid('',true).".".$ext;
            
            require_once 'sql-helper.php';
            executePrepared("UPDATE users SET ".self::PROFILE_PICTURE_PATH."=?, ".self::BIO_FIELD."=? WHERE ".self::USER_ID_FIELD."=?", "sss", $destination, $bio, $loginController->getUserId());            
            
            $uploadController->verifyAndUploadImageFile($image, $destination);
        } else {
            require_once 'includes/exceptions.php';
            throw new UserNotLoggedInException();
        }
    }

    function fetchProfileInfo($userId) {
        require_once 'includes/sql-helper.php';
        $userData = queryPrepared("SELECT ".self::USERNAME_FIELD.", ".self::PROFILE_PICTURE_PATH.", ".self::BIO_FIELD." FROM users WHERE ".self::USER_ID_FIELD."=?", "s", $userId);
        return $userData;
    }

    function fetchCurrentProfileInfo() {
        require_once 'login-controller.php';

        $loginController = new LoginController;

        if ($loginController->isLoggedIn()) {
            return $this->fetchProfileInfo($loginController->getUserId());
        } else {
            require_once 'includes/exceptions.php';
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