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
    <body class = "no-scroll">
        <div class = "bg-cover">
            <div class = "center-content">
                <div class = "center">
                    <div class = "modal-lg">
                        <form action = "../includes/gallery-helper.php" method = "post" enctype = "multipart/form-data">
                            <div class = "form-group">
                                <img src = "../uploads/generic.jpg" onclick = "triggered();" id = "gallery-display">
                                <label for = "gallery-display" id = "uname-style">New Gallery Entry</label>
                                <input type = "file" name = "gallery-image" id = "gallery-image" onchange = "preview(this);" class = "form-control" style = "display: none;">
                            </div>
                            <div class = "form-group">
                                <input type = "text" pattern = ".{4,64}" placeholder = "An interesting title... (4 chars min.)"></input>
                                <textarea name = "desc" id = "desc" pattern = ".{4,1023}" placeholder = "Description (4 chars min.)"></textarea>
                            </div>
                            <div class = "form-group">
                                <button name = "admin-submit" class = "btn btn-info">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

<?php 
}else{
    header("Location: ../login.php?error=Login");
    exit();
}
?>
</main>