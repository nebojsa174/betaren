<?php
include './app/config/config.php';
include './app/config/database.php';

$current_page = basename($_SERVER['PHP_SELF']);

$currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


if (isset($_POST['newsletter_submit'])) {

    $email = $_POST['newsletter_email'];

    $to = 'office@betaren.rs';
    $subject = 'Prijava na newsletter';
    $message = 'Korisnik se prijavio na newsletter sa email adresom: ' . $email;

    // Slanje emaila
    if (mail($to, $subject, $message)) {
        echo '<script>alert("Email je uspešno poslat!");</script>';
    } else {
        echo '<script>alert("Došlo je do greške prilikom slanja emaila.");</script>';
    }
}

?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= isset($page_title) ? $page_title : "Schelkovo Agrohim"; ?></title>
    <meta name="description" content="Šelkovo agrohim, Ščolkovo agrohim, Agrohim Ščolkovo, Šelkovo, Selkovo agrohim Srbija" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Ruski total, ruska hemija, ruski pesticidi, Sprut Extra, ruski total herbicid, ruska zaštita semena, ruski herbicidi, ruska zaštita bilja">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= isset($page_title) ? $page_title : "Schelkovo Agrohim"; ?>" />
    
    <meta name="google-site-verification" content="3w0NRrJXhBtOA0n1mAl1Af2YPdthG9dKFLojck86A4I" />

    <link rel="canonical" href="<?= $currentUrl; ?>" />

    <meta property="og:image" content="<?= ROOT_URL ?>assets/img/betaren_meta.jpg">

    <meta name="twitter:image" content="<?= ROOT_URL ?>assets/img/betaren_meta.jpg" />
	
	<meta property="og:image:width" content="1920" />
	
    <meta property="og:image:height" content="1080" />

    <!-- Add site Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= ROOT_URL ?>assets/img/logo/favicon.png">
    <meta name="msapplication-TileImage" content="https://hasthemes.com/wp-content/uploads/2019/04/cropped-favicon-270x270.png" />
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- w3 -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- CSS
    ========================= -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>assets/css/slick.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>assets/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>assets/css/font.awesome.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>assets/css/animate.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>assets/css/nice-select.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>assets/css/magnific-popup.css">

    <!-- lightbox -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>assets/lightbox/src/css/lightbox.css">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>assets/css/style.css">

    <!--modernizr min js here-->
    <script src="<?= ROOT_URL ?>assets/js/vendor/modernizr-3.7.1.min.js"></script>



    <!-- Structured Data  -->
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "WebSite",
            "name": "Replace_with_your_site_title",
            "url": "Replace_with_your_site_URL"
        }
    </script>

</head>

<body>

    <!--offcanvas menu area start-->
    <div class="body_overlay">

    </div>
    <div class="offcanvas_menu">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="offcanvas_menu_wrapper">
                        <div class="canvas_close">
                            <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                        </div>
                        <div class="header_contact_info">
                            <ul class="d-flex">
                                <li class="text-white"> <i class="icons icon-phone"></i> <a href="tel:+05483716566">+381 63 603 705</a></li>
                                <li class="text-white"> <i class="icon-envelope-letter icons"></i> <a
                                        href="#">office@betaren.rs</a></li>
                            </ul>
                        </div>
                        <div id="menu" class="text-left mt-4">
                            <ul class="offcanvas_main_menu">
                                <li class="menu-item-has-children active">
                                    <a href="<?=ROOT_URL?>">Početna</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">Proizvodi </a>
                                    <ul class="sub-menu">
                                        <li><a href="<?=ROOT_URL?>herbicidi">Herbicidi</a></li>
                                        <li><a href="<?=ROOT_URL?>insekticidi-i-akaricidi">Insekticidi i akaricidi</a></li>
                                        <li><a href="<?=ROOT_URL?>fungicidi">Fungicidi</a></li>
                                        <li><a href="<?=ROOT_URL?>zastita-semena">Zaštita semena</a></li>
                                        <li><a href="<?=ROOT_URL?>regulatori-rasta">Regulatori rasta</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="<?=ROOT_URL?>o-kompaniji">O kompaniji</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="<?=ROOT_URL?>mediji">Mediji</a>
                                </li>
                                <li><a href="<?=ROOT_URL?>kontakt">Kontakt</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--offcanvas menu area end-->