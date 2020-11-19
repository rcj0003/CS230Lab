<?php
require 'dbhandler.php';

$pfpPath = "../uploads/generic.jpg";
$bio = "Default Bio";

require_once 'includes/controllers/profile-controller.php';

try {
    $profileController = new ProfileController;
    $profileInfo = $profileController->fetchCurrentProfileInfo();
    $pfpPath = $profileInfo['picturePath'];
    $bio = $profileInfo['bio'];
}
catch (Exception $e) {
    echo($e);
}

?>