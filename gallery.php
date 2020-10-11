<?php
require 'includes/header.php';
?>

<main>
    <link rel="stylesheet" href="css/gallery.css">
    <div class = "bg-cover">
        <div class = "center modal-lg">
            <h1>Product Gallery</h1>
            <div class = "card-container">
                <?php
                    require 'includes/gallery-fetcher.php';

                    $gallery = fetchGallery();

                    foreach ($gallery as $row) {
                        include 'includes/gallery-card.php';
                    }
                ?>
            </div>
        </div>
    </div>
</main>