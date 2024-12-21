<?php

$page_title = "Ščolkovo Agrohim Beograd - Mediji";
include './includes/header.php';
include './app/classes/Objava.php';

$objava = new Objava($conn);

$objava_slike = $objava->getObjavaSlike();

$objava_videa = $objava->getAllVideos();

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
                        <li><a href="./">Početna</a></li>
                        <li><a href="mediji">Mediji</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!-- Slike -->
<section class="banner_section mb-96">
    <div class="container">
        <div class="section_title mb-60">
            <h2>Slike</h2>
        </div>

        <div class="row">
            <?php if (empty($objava_slike)) : ?>
                <p>Trenutno nema objava u ovoj kategoriji <i class="fa-regular fa-face-frown"></i></p>
            <?php else : ?>
                <?php foreach ($objava_slike as $slika) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <a href="<?= ROOT_URL ?>objava-slike/<?= $slika['naziv_url']; ?>" class="mediji-link">
                            <div class="mediji-slike-container">
                                <div class="mediji-slike-slika">
                                    <img src="<?= $slika['prva_slika']; ?>" alt="">
                                </div>
                                <div class="mediji-slike-datum">
                                    <span><?= $slika['datum']; ?></span>
                                </div>
                                <div class="mediji-slike-naslov">
                                    <h3><?= $slika['naslov']; ?></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</section>

<!-- Video -->
<section class="banner_section mb-96">
    <div class="container">
        <div class="section_title mb-60">
            <h2>Video</h2>
        </div>

        <div class="row shop_wrapper">
            <?php if (empty($objava_videa)) : ?>
                <p>Trenutno nema objava u ovoj kategoriji <i class="fa-regular fa-face-frown"></i></p>
            <?php else : ?>
                <?php foreach ($objava_videa as $video) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <a href="<?= ROOT_URL ?>objava-video/<?= $video['naziv_url']; ?>" class="mediji-link">
                            <div class="mediji-slike-container">
                                <div class="mediji-slike-slika">
                                    <img src="<?= $video['cover']; ?>" alt="">
                                </div>
                                <div class="mediji-slike-datum">
                                    <span><?= $video['datum']; ?></span>
                                </div>
                                <div class="mediji-slike-naslov">
                                    <h3><?= $video['naslov']; ?></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</section>

<?php include './includes/footer.php'; ?>