<?php
require 'dbhandler.php';

$pfpPath = "../uploads/generic.jpg";
$bio = "Default Bio";

if (isset($_SESSION['username'])) {
    $sql = "SELECT picpath, bio FROM profile WHERE uname=?";
    $statement = $conn->stmt_init();

    if ($statement->prepare($sql)) {
        $statement->bind_param("s", $_SESSION['username']);
        $statement->execute();
        $result = $statement->get_result();
        $data = $result->fetch_assoc();

        if (!empty($data)) {
            $pfpPath = $data['picpath'];
            $bio = $data['bio'];
        }

        $statement->close();
        $conn->close();
    }
}
?>