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
        require 'includes/exceptions.php';

        if (!$loginController->isLoggedIn()) {
            throw new UserNotLoggedInException();
        }

        require 'includes/controllers/upload-controller.php';

        $ext = $uploadController->getExtension($icon);
        $destination = "../projects/".uniqid('',true).".".$ext;

        require 'includes/sql-helper.php';
        executePrepared("INSERT INTO projects (".self::POSTER_ID_FIELD.", ".self::STATUS_FIELD.", ".self::TITLE_FIELD.", ".self::DESCRIPTION_FIELD.", ".self::ICON_FIELD.", ".self::DOWNLOAD_LINK_FIELD.") VALUES (?, ?, ?, ?, ?, ?)", "ssssss", $loginController->getUserId(), 1, $title, $description, $destination, $downloadLink);

        $uploadController->verifyAndMoveFile($icon, $destination);
    }

    function getReviewData($galleryId, $quantity) {
        require 'includes/sql-helper.php';

        $data = array(
            "average_review" => round(executeQuery("SELECT AVG(rating) AS average FROM reviews WHERE ".self::PROJECT_ID_FIELD."=?", "s", $galleryId)['average'], 1),
            "review_count" => executeQuery("SELECT COUNT(rating) AS total FROM reviews WHERE ".self::PROJECT_ID_FIELD."=?", "s", $galleryId)['total'],
            "ratings" => executeQuery("SELECT * FROM reviews WHERE ".self::PROJECT_ID_FIELD."=? LIMIT ? ORDER BY ".self::UPLOAD_DATE_FIELD." DESC", "ii", $galleryId, $quantity)
        );

        return $data;
    }

    function createReview($galleryId, $rating, $title, $description) {
        require 'login-controller.php';
        require 'includes/exceptions.php';

        if (!$loginController->isLoggedIn()) {
            throw new UserNotLoggedInException();
        }

        require 'includes/sql-helper.php';
        executePrepared("INSERT INTO reviews (".self::POSTER_ID_FIELD.", ".self::TITLE_FIELD.", ".self::DESCRIPTION_FIELD.", ".self::RATING_FIELD.") VALUES (?, ?, ?, ?)", "ssssss", $loginController->getUserId(), $title, $description, $rating);
    }

    function fetchGalleryEntriesPaginated($pageNumber) {
        require 'includes/pagination.php';
        $paginator = new Paginator(25, "SELECT * FROM projects WHERE ".self::STATUS_FIELD."=1", "");
        return $paginator->getPageNumber($pageNumber);
    }

    function fetchGalleryEntries() {
        require 'includes/sql-helper.php';
        return queryPrepared("SELECT * FROM projects WHERE status=1", "");
    }
}

$galleryController = new GalleryController;

?>