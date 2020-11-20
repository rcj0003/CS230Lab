<?php

class GalleryController {
    const ICON_FIELD = "icon";
    const TITLE_FIELD = "title";
    const DESCRIPTION_FIELD = "description";
    const POSTER_ID_FIELD = "uploaderId";
    const PROJECT_ID_FIELD = "projectId";
    const UPLOAD_DATE_FIELD = "uploadDate";
    const DOWNLOAD_LINK_FIELD = "downloadLink";
    const STATUS_FIELD = "status";
    const RATING_FIELD = "rating";

    function createNewGalleryEntry($icon, $title, $description, $downloadLink) {
        require 'login-controller.php';

        if ($loginController->isLoggedIn()) {
            require 'upload-controller.php';

            $ext = $uploadController->getFileExtension($icon);
            $destination = "../projects/".uniqid('',true).".".$ext;
    
            require '../includes/sql-helper.php';
            executePrepared("INSERT INTO projects (".self::POSTER_ID_FIELD.", ".self::STATUS_FIELD.", ".self::TITLE_FIELD.", ".self::DESCRIPTION_FIELD.", ".self::ICON_FIELD.", ".self::DOWNLOAD_LINK_FIELD.") VALUES (?, ?, ?, ?, ?, ?)", "iissss", $loginController->getUserId(), 1, $title, $description, $destination, $downloadLink);
    
            $uploadController->verifyAndUploadImageFile($icon, $destination);
        } else {
            require_once '../includes/exceptions.php';
            throw new UserNotLoggedInException();
        }
    }

    function getReviews($galleryId, $quantity) {
        require 'includes/sql-helper.php';
        return queryResultPrepared("SELECT * FROM reviews WHERE ".self::PROJECT_ID_FIELD."=? ORDER BY ".self::UPLOAD_DATE_FIELD." DESC LIMIT ?", "ss", $galleryId, $quantity);
    }

    function getReviewData($galleryId, $quantity) {
        require '../includes/sql-helper.php';

        $data = array(
            "average_review" => round(queryPrepared("SELECT AVG(rating) AS average FROM reviews WHERE ".self::PROJECT_ID_FIELD."=?", "s", $galleryId)['average'], 1),
            "review_count" => queryPrepared("SELECT COUNT(rating) AS total FROM reviews WHERE ".self::PROJECT_ID_FIELD."=?", "s", $galleryId)['total'],
            "reviews" => queryResultPrepared("SELECT * FROM reviews WHERE ".self::PROJECT_ID_FIELD."=? ORDER BY ".self::UPLOAD_DATE_FIELD." DESC LIMIT ?", "ss", $galleryId, $quantity)
        );

        return $data;
    }

    function createReview($galleryId, $rating, $title, $description) {
        require 'login-controller.php';

        if ($loginController->isLoggedIn()) {
            require '../includes/sql-helper.php';
            return executePrepared("INSERT INTO reviews (".self::PROJECT_ID_FIELD.", ".self::POSTER_ID_FIELD.", ".self::TITLE_FIELD.", ".self::DESCRIPTION_FIELD.", ".self::RATING_FIELD.") VALUES (?, ?, ?, ?, ?)", "sssss", $galleryId, $loginController->getUserId(), $title, $description, $rating);
        } else {
            require '../includes/exceptions.php';
            throw new UserNotLoggedInException();
        }
    }

    function fetchGalleryEntriesPaginated($pageNumber) {
        require 'includes/pagination.php';
        $paginator = new Paginator(25, "SELECT * FROM projects WHERE ".self::STATUS_FIELD."=?", "i", 1);
        return $paginator->getPageNumber($pageNumber);
    }

    function fetchGalleryEntries() {
        require_once 'includes/sql-helper.php';
        return queryResultPrepared("SELECT * FROM projects ORDER BY uploadDate DESC", "");
    }

    function fetchGalleryEntry($galleryId) {
        require_once 'includes/sql-helper.php';
        return queryPrepared("SELECT * FROM projects WHERE ".self::PROJECT_ID_FIELD."=?", "s", $galleryId);
    }
}

$galleryController = new GalleryController;

?>