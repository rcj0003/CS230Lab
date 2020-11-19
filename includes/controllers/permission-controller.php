<?php

class PermissionController {
    const USER_ID_FIELD = "userId";
    const PERMISSION_FIELD = "permission";

    function hasPermission($permission) {
        require_once 'login-controller.php';

        if ($loginController->isLoggedIn()) {
            include 'includes/sql-helper.php';
            return !empty(queryPrepared("SELECT * FROM permissions WHERE ".self::USER_ID_FIELD."=? AND ".self::PERMISSION_FIELD."=?", "ss", $loginController->getUserId(), $permission));
        } else {
            return false;
        }
    }

}

$permissionController = new PermissionController;

?>