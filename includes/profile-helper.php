<?php
require 'dbhandler.php';

$pfpPath = "../uploads/generic.jpg";
$bio = "Default Bio";

require 'profile-controller.php';

try {
    $profileInfo = $profileController->fetchCurrentProfileInfo();

    $pfpPath = $profileInfo['picturePath'];
    $pfpPath = $profileInfo['bio'];
}
catch (Exception $e) {
    echo($e);
}

?>