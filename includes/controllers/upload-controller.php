<?php

define('KB', 1024);
define('MB', 1048576);

class FileException extends Exception {
    function __construct($message) {
        parent::__construct($message);
    }
}

class UploadController {
    function getFileExtension($file) {
        return strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    }

    function verifyAndUploadImageFile($file, $destination) {
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];
    
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
        $allowed = array('jpg', 'jpeg', 'png', 'svg');
    
        if ($fileError !== 0) {
            throw new FileException("Unknown error occured while uploading file.");
        }
    
        if (!in_array($ext, $allowed)) {
            throw new FileException("Extension not allowed.");
        }
    
        if ($fileSize > 4 * MB) {
            throw new FileException("File exceeds maximum size.");
        }

        move_uploaded_file($fileTmpName, $destination);
    }
}

$uploadController = new UploadController;

?>