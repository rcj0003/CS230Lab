<main>
    <?php
        include 'includes/header.php'
    ?>
    <body class = "no-scroll">
        <div class = "bg-cover">
            <div class = "row">
                <div id =  "loginCarousel" class = "carousel slide col-md-8 offset-md-2" data-ride = "carousel" style = "margin-top: 50px; margin-bottom: 50px; border-radius: 5%;">
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
                <div>
                    <form class = "modal-sm" action = "../includes/login-helper.php" action = "post">
                        <div class = "logo-header">
                            <img src = "../images/terminal.png">
                            <h1>Sign in</h1>
                        </div>
                        
                        <input class = "form-control" type = "email" name =  "email" placeholder = "Email"  maxlength = "64" required autofocus>
                        <input class = "form-control" type = "password" pattern = "0-9A-Za-z!@#$_{8,64}" name =  "password" placeholder = "Password" maxlength = "64" required>
                        
                        <div class = "checkbox vertical-space-10">
                            <label for = "remember">
                                <input type = "checkbox" name = "remember"> Stay signed in
                            </label>
                        </div>

                        <div class = "vertical-space-10">
                            <p>
                                Don't have an account?
                                <a href = "../signup.php">Sign-up!</a>
                            </p>
                        </div>

                        <button class = "btn btn-info" name = "login-submit">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</main>