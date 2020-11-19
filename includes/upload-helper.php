<?php
session_start();

if (isset($_POST['prof-submit'])) {
    require_once 'controllers/profile-controller.php';

    $file = $_FILES['prof-image'];
    $bio = $_POST['bio'];

    $profileController = new ProfileController;
    $profileController->updateProfile($file, $bio);
}

header("Location: ../profile.php");
exit();