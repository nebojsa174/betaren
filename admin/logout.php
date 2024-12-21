<?php

include '../app/config/config.php';
include '../app/config/database.php';
session_start();

$_SESSION = [];
session_destroy();

$_SESSION['userLoginStatus'] = false;
header('Location: ' . ADMIN_URL . 'login.php');
exit();
?>
