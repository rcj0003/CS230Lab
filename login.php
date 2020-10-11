<?php
    include 'includes/header.php'
?>
    <body>
        <div class = "bg-cover">
            <div class = "row">
                <div id = "loginCarousel" class = "carousel slide col-md-8 offset-md-2" data-ride = "carousel" style = "margin-top: 50px; margin-bottom: 50px; border-radius: 5%;">
                    <div class = "carousel-inner">
                        <div class = "carousel-item active">
                            <img class = "d-block mx-auto img-limit" src = "../images/bg1.jpg" alt = "First slide">
                        </div>

                        <div class = "carousel-item">
                            <img class = "d-block mx-auto img-limit" src = "../images/bg2.jpg" alt = "Second slide">
                        </div>

                        <div class = "carousel-item">
                            <img class = "d-block mx-auto img-limit" src = "../images/bg3.jpg" alt = "Third slide">
                        </div>
                    </div>
                </div>
            </div>

            <div class = "center-content">
                <div class = "vertical-center">
                    <form class = "form-signin" style = "background-color: white;">
                        <div class = "logo-header">
                            <img src = "../images/terminal.png">
                            <h1>Sign in</h1>
                        </div>
                        
                        <input class = "form-control" type = "email" id = "email" placeholder = "Email"  maxlength = "64" required autofocus>
                        <input class = "form-control" type = "password" pattern = "0-9A-Za-z!@#$_{8,64}" id = "password" placeholder = "Password" maxlength = "64" required>
                        
                        <div class = "checkbox">
                            <label for = "remember">
                                <input type = "checkbox" id = "remember"> Stay signed in
                            </label>
                        </div>
        
                        <button class = "btn btn-info">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>