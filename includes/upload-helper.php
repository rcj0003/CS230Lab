<?php
session_start();

define('KB', 1024);
define('MB', 1048576);

if (isset($_POST['prof-submit'])) {
    require 'dbhandler.php';
   
    $username = $_SESSION['username'];
    $file = $_FILES['prof-image'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    $bio = $_POST['bio'];

    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $allowed = array('jpg', 'jpeg', 'png', 'svg');

    if ($fileError !== 0) {
        header("Location: ../profile.php?error=UploadError");
        exit();
    }

    if (!in_array($ext, $allowed)) {
        header("Location: ../profile.php?error=InvalidType");
        exit();
    }

    if ($fileSize > 4 * MB) {
        header("Location: ../profile.php?error=FileSizeExceeded");
        exit();
    } else {
        $newName = uniqid('',true).".".$ext;
        $destination = "../uploads/".$newName;

        $sql = "UPDATE profile SET picpath=?, bio=? WHERE uname=?";
        $statement = $conn->stmt_init();

        if ($statement->prepare($sql)) {
            $statement->bind_param("sss", $destination, $bio, $_SESSION['username']);
            $statement->execute();
            $statement->store_result();
    
            move_uploaded_file($fileTmpName, $destination);
    
            $statement->close();
            $conn->close();

            header("Location: ../profile.php?success=UploadedSuccess");
            exit();
        } else {
            header("Location: ../profile.php?error=SQLInjection");
            exit();
        }
    }
} else {
    header("Location: ../profile.php");
    exit();
}