<?php
include '../app/config/config.php';
include '../app/config/database.php';
include '../app/classes/Objava.php';

$objave = new Objava($conn);

$id = $_GET['id'];

$objava = $objave->deleteVidea($id);

header("location:" . ADMIN_URL . "pregled-medija-video.php");
exit();

?>