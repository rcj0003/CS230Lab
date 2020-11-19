<?php

class GalleryController {
    const ICON_FIELD = "iconPath";
    const TITLE_FIELD = "title";
    const DESCRIPTION_FIELD = "description";
    const POSTER_ID_FIELD = "uploaderId";
    const PROJECT_ID_FIELD = "projectId";
    const UPLOAD_DATE_FIELD = "uploadDate";
    const DOWNLOAD_LINK_FIELD = "downloadLink";
    const STATUS_FIELD = "status";

    function createNewGalleryEntry($icon, $title, $description, $downloadLink) {
        require 'login-controller.php';
        require 'exceptions.php';

        if (!$loginController->isLoggedIn()) {
            throw new UserNotLoggedInException();
        }

        require 'upload-controller.php';

        $ext = $uploadController->getExtension($icon);
        $destination = "../projects/".uniqid('',true).".".$ext;
        $uploadController->verifyAndMoveFile($icon, $desination);

        require 'sql-helper.php';

        executePrepared("INSERT INTO projects (".self::POSTER_ID_FIELD.", ".self::STATUS_FIELD.", ".self::TITLE_FIELD.", ".self::DESCRIPTION_FIELD.", ".self::ICON_FIELD.", ".self::DOWNLOAD_LINK_FIELD.") VALUES (?, ?, ?, ?, ?, ?)", "ssssss", $loginController->getUserId(), 1, $title, $description, $destination, $downloadLink);
    }

    function getReviewData($galleryId, $quantity) {
        require 'sql-helper.php';
        return executeQuery("SELECT * FROM reviews WHERE ".self::PROJECT_ID_FIELD."=? LIMIT ?", "ii", $galleryId, $quantity);
    }

    function createReview($galleryId, $rating, $title, $description) {
        require 'login-controller.php';
        require 'exceptions.php';

        if (!$loginController->isLoggedIn()) {
            throw new UserNotLoggedInException();
        }

        require 'sql-helper.php';
        executePrepared("INSERT INTO reviews (".self::POSTER_ID_FIELD.", ".self::TITLE_FIELD.", ".self::DESCRIPTION_FIELD.", ".self::RATING_FIELD.") VALUES (?, ?, ?, ?)", "ssssss", $loginController->getUserId(), $title, $description, $rating);
    }

    function fetchGalleryEntries($pageNumber) {
        require 'pagination.php';
        $paginator = new Paginator(25, "SELECT * FROM projects WHERE ".self::STATUS_FIELD."=1", "");
        return $paginator->getPageNumber($pageNumber);
    }
}

?>