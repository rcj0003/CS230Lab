<?php

$item_id = $_GET['id'];

try {
    require_once 'includes/controllers/gallery-controller.php';
    require_once 'includes/controllers/profile-controller.php';

    $result = $galleryController->getReviews($item_id, 4);

    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $profileInfo = $profileController->fetchProfileInfo($row['uploaderId']);
    
            echo('
            
            <div class = "card mx-auto" style = "width: 30%; padding = 5px; margin-bottom: 10px;">
                <div class = "media">
                    <img class = "mr-3" src = "'.$profileInfo['picturePath'].'" style = "max-width: 75px; max-height: 75px; border-radius: 50%;">
                    <div class = "media-body">
                        <h4 class = "mt-0">'.$profileInfo['username'].'</h4>
                        <h5 class = "mt-0">'.$row['title'].'</h5>
                        <p>'.$row['uploadDate'].'</p>
                        <p>'.$row['description'].'</p>
                    </div>
                </div>
            </div>
            
            ');
        }
    } else {
        echo('<h5 style = "text-align: center">No reviews yet! Be the first to review!<h5>');
    }
}
catch (Exception $e) {
    header("Location: ../error500.php");
    exit();
}