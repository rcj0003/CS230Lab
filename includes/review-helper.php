<?php

if (isset($_POST['review-submit'])) {
    session_start();
    
    $pid = $_POST['item_id'];

    require 'controllers/gallery-controller.php';
    $result = $galleryController->createReview($pid, $_POST['rating'], $_POST['review-title'], $_POST['review-text']);

    header("Location: ../review.php?id=".$pid."&success=".$result);
    exit();
}