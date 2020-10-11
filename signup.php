<main>
    <?php
        require "includes/header.php"
    ?>
    <div class = "bg-cover">
        <div class = "center-content">
            <div class = "center">
                <form action = "includes/signup-helper.php" method = "post" class = "modal-lg">
                    <div class = "logo-header">
                        <img src = "../images/terminal.png">
                        <h1>Sign up</h1>
                    </div>

                    <div class = "vertical-space-10">
                        <div class = "multi-input-line">
                            <input class = "form-control" type = "text" pattern = "[A-Za-z'- ]{1,32}" name = "first_name" placeholder = "First Name"  maxlength = "32" required autofocus>
                            <input class = "form-control" type = "text" pattern = "[A-Za-z'- ]{1,32}" name = "last_name" placeholder = "Last Name"  maxlength = "32" required autofocus>
                        </div>
                    </div>

                    <input class = "form-control" type = "email" name = "email" placeholder = "Email"  maxlength = "64" required autofocus>
                    <input class = "form-control" type = "text" pattern = "[0-9A-Za-z!_]{4,20}" name = "username" placeholder = "Username"  maxlength = "20" required autofocus>

                    <div class = "vertical-space-10">
                        <div class = "multi-input-line">
                            <input class = "form-control" type = "password" pattern = "[0-9A-Za-z!@#$_]{8,64}" name = "password" placeholder = "Password (8 chars min.)" maxlength = "64" required>
                            <input class = "form-control" type = "password" pattern = "[0-9A-Za-z!@#$_]{8,64}" name = "confirm_password" placeholder = "Confirm Password" maxlength = "64" required>
                        </div>
                    </div>

                    <div>
                        <p>
                            Already a member?
                            <a href = "login.html">Login!</a>
                        </p>
                    </div>

                    <button name = "signup_submit" class = "btn btn-info">Sign up</button>
                </form>
            </div>

        </div>
    </div>
</main>