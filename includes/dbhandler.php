<?php

$servename = "localhost";
$DBuname = "root";
$DBPass = "";
$DBname = "1k0z";

$conn = mysqli_connect($servename, $DBuname, $DBPass, $DBname);

if (!$conn) {
    die("Connection failed...".mysqli_connect_error());
    # code...
}

