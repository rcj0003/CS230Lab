<?php
    session_start();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/0809ee8fa6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/signup.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="../css/about.css">
</head>
<header>
    <nav class = "navbar navbar-dark bg-dark">
        <a class = "navbar-brand" href = "#">OzDev</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class = "collapse navbar-collapse" id = "navbarSupportedContent">
            <ul class = "navbar-nav mr-auto">
                <li class = "nav-item">
                    <li class = "nav-item">
                        <a class = "nav-link" href = "../about.php">Home</a>
                    </li>
                </li>

                <li class = "nav-item">
                    <li class = "nav-item">
                        <a class = "nav-link" href = "../gallery.php">Product Gallery</a>
                    </li>
                </li>

                <?php
                    if (isset($_SESSION['userId'])) {
                        ?>

                        <li class = "nav-item dropdown">
                            <a class = "nav-link dropdown-toggle" href = "#" id = "navbarDropdown" role = "button" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "false">
                                Me
                            </a>

                            <div class = "dropdown-menu" aria-labelledby = "navbarDropdown">
                                <a class = "dropdown-item" href = "../profile.php">Profile</a>
                                <div class = "dropdown-divider"></div>
                                <a class = "dropdown-item" href = "../includes/logout.php">Logout</a>
                            </div>
                        </li>

                        <?php
                    } else {
                        ?>

                        <li class = "nav-item">
                            <a class = "nav-link" href = "../login.php">Login / Signup</a>
                        </li>

                        <?php
                    }
                ?>
            </ul>
            
            <form class = "form-inline my-2 my-lg-0">
                <input class = "form-control mr-sm-2" type = "search" placeholder = "Search" aria-label = "Search">
                <button class = "btn btn-info my-2 my-sm-0" type = "submit">Search for product</button>
            </form>
        </div>
    </nav>
</header>