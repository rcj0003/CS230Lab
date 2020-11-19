<?php

session_start();

if (isset($_POST['gallery-submit'])) {
    require 'controllers/gallery-controller.php';

    $file = $_FILES['gallery-image'];
    $title = $_POST['title'];
    $description = $_POST['desc'];
    $downloadLink = $_POST['downloadLink'];

    try {
        $galleryController->createNewGalleryEntry($file, $title, $description, $downloadLink);
    }
    catch (Exception $e) {
        header("Location: ../admin.php?error=UnknownFileError");
        exit();
    }
} else {
    header("Location: ../admin.php");
    exit();
}

?>