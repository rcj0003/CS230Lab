<?php
require "includes/header.php"
?>

<main>
    <div class = "bg-cover">
        <div class = "center-content">
            <div class = "vertical-center">
                <form action = "includes/signup-helper.php" class = "form-signup">
                    <div class = "logo-header">
                        <img src = "../images/terminal.png">
                        <h1>Sign up</h1>
                    </div>

                    <div class = "vertical-space-10">
                        <div class = "multi-input-line">
                            <input class = "form-control" type = "text" pattern = "A-Za-z'- {1,32}" id = "first_name" placeholder = "First Name"  maxlength = "32" required autofocus>
                            <input class = "form-control" type = "text" pattern = "A-Za-z'- {1,32}" id = "last_name" placeholder = "Last Name"  maxlength = "32" required autofocus>
                        </div>
                    </div>

                    <input class = "form-control" type = "email" id = "email" placeholder = "Email"  maxlength = "64" required autofocus>
                    <input class = "form-control" type = "text" pattern = "0-9A-Za-z!_{4,20}" id = "username" placeholder = "Username"  maxlength = "20" required autofocus>

                    <div class = "vertical-space-10">
                        <div class = "multi-input-line">
                            <input class = "form-control" type = "password" pattern = "0-9A-Za-z!@#$_{8,64}" id = "password" placeholder = "Password (8 chars min.)" maxlength = "64" required>
                            <input class = "form-control" type = "confirm_password" pattern = "0-9A-Za-z!@#$_{8,64}" id = "password" placeholder = "Confirm Password" maxlength = "64" required>
                        </div>
                    </div>

                    <div>
                        <p>
                            Already a member?
                            <a href = "login.html">Login!</a>
                        </p>
                    </div>

                    <button class = "btn btn-info">Sign up</button>


                </form>
            </div>

        </div>
    </div>
</main>