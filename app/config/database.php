<?php
$servername = "";
$username = "";
$password = "";
$database = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Konekcija nije uspela: " . mysqli_connect_error());
}

