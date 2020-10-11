<?php

function fetchGallery() {
    require 'dbhandler.php';
    $sql = "SELECT * FROM products ORDER BY upload_date DESC";
    $statement = $conn->stmt_init();

    if (!$statement->prepare($sql)) {
        return array();
    }

    $statement->execute();
    $result = $statement->get_result();
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $statement->close();
    $conn->close();
    return $data;
}

?>