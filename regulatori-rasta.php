<?php

$page_title = "Ščolkovo Agrohim Beograd - Regulatori rasta";
include './includes/header.php';
include './app/classes/Proizvod.php';

$proizvod = new Proizvod($conn);

$regulatori_rasta = $proizvod->getProductByCategory("regulatori_rasta");
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
                        <li><a href="<?= ROOT_URL ?>proizvodi">Proizvodi</a></li>
                        <li>Regulatori rasta</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<section class="banner_section mb-109">
    <div class="container">
        <div class="section_title mb-60">
            <h2>Regulatori rasta</h2>
        </div>

        <div class="row shop_wrapper">
            <?php if (empty($regulatori_rasta)) : ?>
                <p>Trenutno nema proizvoda u ovoj kategoriji <i class="fa-regular fa-face-frown"></i></p>
            <?php else : ?>
                <?php foreach ($regulatori_rasta as $regulator) : ?>
                    <?php
                    $regulator_opis = $regulator['opis'];
                    $prvi_red = explode("\n", $regulator_opis)[0];
                    $prvi_red = str_replace("+", "<br>+", $prvi_red);
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 ">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a href="<?= ROOT_URL ?>proizvod-detalji/<?= $regulator['naziv_url']; ?>">
                                    <img class="primary_img" src="<?= ROOT_URL ?>betaren/<?= $regulator['fotografija']; ?>" alt="consectetur">
                                </a>
                            </div>
                            <div class="product_content grid_content text-center">
                                <h4 class="product_name"><a href="<?= ROOT_URL ?>proizvod-detalji/<?= $regulator['naziv_url']; ?>"><?= $regulator['naziv']; ?></a></h4>
                                <p><?= $prvi_red ?></p>
                                <div class="add_to_cart">
                                    <a class="btn btn-primary" href="<?= ROOT_URL ?>proizvod-detalji/<?= $regulator['naziv_url']; ?>">Pročitaj više</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</section>

<?php include './includes/footer.php'; ?>