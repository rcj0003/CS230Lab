<?php 
require_once 'dbhandler.php';
date_default_timezone_set('UTC');

if (isset($_POST['review-submit'])) {
    session_start();
    $uname = $_SESSION['username'];
    $title = $_POST['review-title'];
    $date = date('Y-m-d H:i:s');
    $content = $_POST['review-text'];
    $rating = $_POST['rating'];
    $pid = $_POST['item_id'];

    $sql = "INSERT INTO reviews (item_id, uname, title, content, date, rating) VALUES (?,?,?,?,?,?)";
    $statement = $conn->stmt_init();

    if ($statement->prepare($sql)) {
        $statement->bind_param("issssi", $pid, $uname, $title, $content, $date, $rating);
        $statement->execute();
        $statement->store_result();

        $statement->close();
        $conn->close();

        header("Location: ../review.php?id=".$pid."&success=true");
        exit();
    } else {
        header("Location: ../review.php?id=".$pid."&error=SQLInjection");
        exit();
    }
}