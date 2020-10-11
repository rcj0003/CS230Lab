<?php
require 'includes/header.php';
?>

<main>
    <link rel="stylesheet" href="css/gallery.css">
    <h1>Product Gallery</h1>
    <div class = "gallery-container">
        <?php
            require 'includes/gallery-fetcher.php';

            $gallery = fetchGallery();

            foreach ($gallery as $row) {
                include 'includes/gallery-card.php';
            }
        ?>
    </div>
</main>