<?php 
require 'includes/header.php'
?>

<main>
    <?php
        if (!isset($_SESSION['uid'])) {
            header("Location: ../login.php");
            exit();
        }

        include 'html/profile.html'
    ?>
</main>