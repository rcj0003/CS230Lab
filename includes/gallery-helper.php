<?php 
require 'dbhandler.php';

define('KB', 1024);
define('MB', 1048576);

if (isset($_POST['gallery-submit'])) {
    $file = $_FILES['gallery-image'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    $title = $_POST['title'];
    $dscpt = $_POST['desc'];

    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $allowed = array('jpg', 'jpeg', 'png', 'svg');

    if ($fileError !== 0) {
        header("Location: ../admin.php?error=UploadError");
        exit();
    }

    if (!in_array($ext, $allowed)) {
        header("Location: ../admin.php?error=InvalidType");
        exit();
    }

    if ($fileSize > 4 * MB) {
        header("Location: ../admin.php?error=FileSizeExceeded");
        exit();
    } else {
        $newName = uniqid('',true).".".$ext;
        $destination = "../products/".$newName;

        $sql = "INSERT INTO products (picpath, title, description) VALUES (?,?,?)";
        $statement = $conn->stmt_init();

        if ($statement->prepare($sql)) {
            $statement->bind_param("sss", $destination, $title, $dscpt);
            $statement->execute();
            $statement->store_result();
    
            move_uploaded_file($fileTmpName, $destination);
    
            $statement->close();
            $conn->close();

            header("Location: ../admin.php?success=UploadedSuccess");
            exit();
        } else {
            header("Location: ../admin.php?error=SQLInjection");
            exit();
        }
    }
} else {
    header("Location: ../admin.php");
    exit();
}

?>