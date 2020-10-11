<?php 
require 'includes/header.php';
?>

<main>
    <?php
        if (!isset($_SESSION['uid'])) {
            header("Location: ../login.php");
            exit();
        }
        
        require 'includes/profile-helper.php';
    ?>

    <style>
        .center-me {
            display: flex;
            justify-content: center;
            padding: 10px;
            text-align: "center";
        }
        #prof-display {
            display: block;
            width: 150px;
            margin: 10px auto;
            border-radius: 50%;
        }

        #uname-style {
            font-size: 20px;
            font-family: "Lucida Console", Courier, monospace;
            font-weight: bold;
        }

        textarea {
            resize: none;
            display: inline-block;
            word-wrap: break-word;
            overflow-wrap: anywhere;
            width: 80%;
            height: 75px;
        }
    </style>

    <script>
        function triggered(){
            document.querySelector("#prof-image").click();
        }

        function preview(e){
            if(e.files[0]){
                var reader = new FileReader();

                reader.onload = function(e){
                    document.querySelector('#prof-display').setAttribute('src',e.target.result);
                }
                reader.readAsDataURL(e.files[0]);

            }
        }
    </script>

    <body class = "no-scroll">
        <div class = "bg-cover">
            <div class = "center-content">
                <div class = "center">
                    <div class = "modal-lg">
                        <form action = "../includes/upload-helper.php" method = "post" enctype = "multipart/form-data">
                            <div class = "form-group">
                                <img src = "<?php echo($pfpPath); ?>" onclick = "triggered();" id = "prof-display">
                                <label for = "prof-display" id = "uname-style"><?php echo($_SESSION['username']); ?></label>
                                <input type = "file" name = "prof-image" id = "prof-image" onchange = "preview(this);" class = "form-control" style = "display: none;">
                            </div>
                            <div class = "form-group">
                                <textarea name = "bio" name = "bio" id = "bio" pattern = ".{2,255}"><?php echo($bio); ?></textarea>
                            </div>
                            <div class = "form-group">
                                <button name = "profile-submit" class = "btn btn-info">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</main>