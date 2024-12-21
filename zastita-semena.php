<?php

$page_title = "Ščolkovo Agrohim Beograd - Zaštita semena";
include './includes/header.php';
include './app/classes/Proizvod.php';

$proizvod = new Proizvod($conn);

$zastita_semena = $proizvod->getProductByCategory("zastita_semena");
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
                        <li>Zaštita semena</li>
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
            <h2>Zaštita semena</h2>
        </div>

        <div class="row shop_wrapper">
            <?php if (empty($zastita_semena)) : ?>
                <p>Trenutno nema proizvoda u ovoj kategoriji <i class="fa-regular fa-face-frown"></i></p>
            <?php else : ?>
                                                <?php foreach ($zastita_semena as $zastita) : ?>
                    <?php
                    $zastita_opis = $zastita['opis'];
                    $prvi_red = explode("\n", $zastita_opis)[0];
                    $prvi_red = str_replace("+", "<br>+", $prvi_red);
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 ">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a href="<?= ROOT_URL ?>proizvod-detalji/<?= $zastita['naziv_url']; ?>">
                                    <img class="primary_img" src="<?= ROOT_URL ?>betaren/<?= $zastita['fotografija']; ?>" alt="consectetur">
                                </a>
                            </div>
                            <div class="product_content grid_content text-center">
                                <h4 class="product_name"><a href="<?= ROOT_URL ?>proizvod-detalji/<?= $zastita['naziv_url']; ?>"><?= $zastita['naziv']; ?></a></h4>
                                <p><?= $prvi_red ?></p>
                                <div class="add_to_cart">
                                    <a class="btn btn-primary" href="<?= ROOT_URL ?>proizvod-detalji/<?= $zastita['naziv_url']; ?>">Pročitaj više</a>
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