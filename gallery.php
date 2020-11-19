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
                    require 'includes/controllers/gallery-controller.php';

                    while ($row = $galleryController->fetchGalleryEntries()) {
                        include 'includes/gallery-card.php';
                    }
                ?>
            </div>
        </div>
    </div>
</main>