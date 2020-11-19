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
                    require_once 'includes/controllers/gallery-controller.php';
                    
                    $galleryController = new GalleryController;
                    $gallery = $galleryController->fetchGalleryEntries();

                    while ($row = $gallery->fetch_assoc()) {
                        include 'includes/gallery-card.php';
                    }
                ?>
            </div>
        </div>
    </div>
</main>