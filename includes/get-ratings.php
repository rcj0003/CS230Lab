<?php 

include 'dbhandler.php';

$id = $_GET['id'];

$sqlAvg = "SELECT AVG(rating) AS AVGRATE FROM reviews WHERE item_id='$id' ORDER BY date DESC";
$sqlTotal = "SELECT count(rating) AS total FROM reviews WHERE item_id='$id'";

$query = $conn->query($sqlAvg);
$row = $query->fetch_assoc();

$query2 = $conn->query($sqlTotal);
$row2 = $query2->fetch_assoc();

$avg = round($row['AVGRATE'], 1);

echo('

<div class = "container" style = "text-align: center">
    <h1>'.$avg.'</h1>
    <div class = "container" style = "margin-bottom: 10px;">'.stars($avg).'</div>
    <p>Number of ratings: '.round($row2['total']).'</p>    
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