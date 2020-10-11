<?php 
require 'includes/header.php';
require 'includes/dbhandler.php';
?>

<main>
<link rel="stylesheet" href="css/admin.css">
<script src="js/upload-display.js"></script>
<?php
if (isset($_SESSION['uid'])) {
?>    
<div class="h-50 center-me text-center">
    <div class="my-auto">
        
    </div>
</div>

<div class="gallery-upload">

</div>


<?php 
}else{
    header("Location: ../login.php?error=Login");
    exit();
}
?>
</main>