<?php 

include 'controllers/gallery-controller.php';

$reviewData = $galleryController->getReviewData($_GET['id'], 10);

echo('

<div class = "container" style = "text-align: center">
    <h1>'.$reviewData['average_review'].'</h1>
    <div class = "container" style = "margin-bottom: 10px;">'.stars($reviewData['average_review']).'</div>
    <p>Number of ratings: '.round($reviewData['review_count']).'</p>    
</div>

');

function stars($av){
    $s = "";
    if ($av == 0) {
        for ($i=0; $i < 5; $i++) { 
            $s .= '<i class="fa fa-star fa-2x" style="color:grey"></i>';
        }  
    }
    for ($i=0; $i < floor($av); $i++) { 
        $s .= '<i class="fa fa-star fa-2x" style="color:goldenrod"></i>';
    }
    if (($av - floor($av)) > 0.4) {
        $s .= '<i class="fas fa-star-half fa-2x" style="color:goldenrod"></i>';
    }
    return $s;
}