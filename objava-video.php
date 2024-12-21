<?php

$page_title = "Ščolkovo Agrohim Beograd - Mediji";
include './includes/header.php';
include './app/classes/Objava.php';

$objava = new Objava($conn);

$naziv_url = $_GET['naziv_url'];

$video = $objava->getVideoByUrl($naziv_url);

$poslednje_objave = $objava->getLastVideos();
?>

<!-- Navbar -->
<?php include './includes/navbar.php'; ?>

<!--breadcrumbs area start-->
<div class="breadcrumbs_area breadcrumbs_product">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="<?= ROOT_URL ?>">Početna</a></li>
                        <li><a href="<?= ROOT_URL ?>mediji">Mediji</a></li>
                        <li><?=$video['naslov'];?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!-- Video -->
<section class="banner_section mb-96">
    <div class="container">
        <div class="section_title mb-30 naslov-videa">
            <h2><?= $video['naslov']; ?></h2>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="video">
                    <video width="100%" height="auto" controls>
                        <source src="<?= ROOT_URL ?><?= $video['video']; ?>">
                    </video>
                </div>
                <p><?= $video['datum']; ?></p>
                <p><?= $video['tekst']; ?></p>
            </div>
            <div class="col-lg-4">
                <div class="poslednje-objave-video-container">
                    <h2>Poslednje objave:</h2>
                    <?php foreach ($poslednje_objave as $objava) : ?>
                        <span class="poslednja-objava-datum"><?=$objava['datum'];?></span>
                        <div class="poslednja-objava-video-div">
                            <img src="<?= ROOT_URL ?><?=$objava['cover'];?>" alt="">
                            <a href="<?= ROOT_URL ?>objava-video/<?= $objava['naziv_url']; ?>" class="poslednja-objava-naslov"><?=$objava['naslov'];?></a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include './includes/footer.php'; ?>