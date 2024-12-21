<?php

$page_title = "Ščolkovo Agrohim Beograd - Proizvodi";
include './includes/header.php';
include './app/classes/Proizvod.php';

$proizvod = new Proizvod($conn);

$herbicidi = $proizvod->getProductByCategory("herbicidi");
$insekticidi = $proizvod->getProductByCategory("insekticidi_i_akaricidi");
$fungicidi = $proizvod->getProductByCategory("fungicidi");
$regulatori_rasta = $proizvod->getProductByCategory("regulatori_rasta");
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
                        <li><a href="<?= ROOT_URL?>">Početna</a></li>
                        <li><a href="proizvodi">Proizvodi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!-- Herbicidi -->
<section class="banner_section mb-96">
    <div class="container">
        <div class="section_title mb-60">
            <a href="herbicidi">
                <h2>Herbicidi</h2>
            </a>
        </div>
        <div class="row shop_wrapper">
            <?php if (empty($herbicidi)) : ?>
                <p>Trenutno nema proizvoda u ovoj kategoriji <i class="fa-regular fa-face-frown"></i></p>
            <?php else : ?>
                <?php foreach ($herbicidi as $herbicid) : ?>
                    <?php
                    $herbicid_opis = $herbicid['opis'];
                    $prvi_red = explode("\n", $herbicid_opis)[0];
                    $prvi_red = str_replace("+", "<br>+", $prvi_red);
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 ">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a href="<?= ROOT_URL ?>proizvod-detalji/<?= $herbicid['naziv_url']; ?>">
                                    <img class="primary_img" src="<?= ROOT_URL ?>betaren/<?= $herbicid['fotografija']; ?>" alt="consectetur">
                                </a>
                            </div>
                            <div class="product_content grid_content text-center">
                                <h4 class="product_name"><a href="<?= ROOT_URL ?>proizvod-detalji/<?= $herbicid['naziv_url']; ?>"><?= $herbicid['naziv']; ?></a></h4>
                                <p><?= $prvi_red ?></p>
                                <div class="add_to_cart">
                                    <a class="btn btn-primary" href="<?= ROOT_URL ?>proizvod-detalji/<?= $herbicid['naziv_url']; ?>">Pročitaj više</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</section>

<!-- Insekticidi i akaricidi -->
<section class="banner_section mb-96">
    <div class="container">
        <div class="section_title mb-60">
            <a href="insekticidi-i-akaricidi">
                <h2>Insekticidi i akaricidi</h2>
            </a>
        </div>

        <div class="row shop_wrapper">
            <?php if (empty($insekticidi)) : ?>
                <p>Trenutno nema proizvoda u ovoj kategoriji <i class="fa-regular fa-face-frown"></i></p>
            <?php else : ?>
                <?php foreach ($insekticidi as $insekticid) : ?>
                    <?php
                    $insekticid_opis = $insekticid['opis'];
                    $prvi_red = explode("\n", $insekticid_opis)[0];
                    $prvi_red = str_replace("+", "<br>+", $prvi_red);
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 ">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a href="<?= ROOT_URL ?>proizvod-detalji/<?= $insekticid['naziv_url']; ?>">
                                    <img class="primary_img" src="<?= ROOT_URL ?>betaren/<?= $insekticid['fotografija']; ?>" alt="consectetur">
                                </a>
                            </div>
                            <div class="product_content grid_content text-center">
                                <h4 class="product_name"><a href="<?= ROOT_URL ?>proizvod-detalji/<?= $insekticid['naziv_url']; ?>"><?= $insekticid['naziv']; ?></a></h4>
                                <p><?= $prvi_red ?></p>
                                <div class="add_to_cart">
                                    <a class="btn btn-primary" href="<?= ROOT_URL ?>proizvod-detalji/<?= $insekticid['naziv_url']; ?>">Pročitaj više</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</section>

<!-- Fungicidi -->
<section class="banner_section mb-96">
    <div class="container">
        <div class="section_title mb-60">
            <a href="fungicidi">
                <h2>Fungicidi</h2>
            </a>
        </div>

        <div class="row shop_wrapper">
            <?php if (empty($fungicidi)) : ?>
                <p>Trenutno nema proizvoda u ovoj kategoriji <i class="fa-regular fa-face-frown"></i></p>
            <?php else : ?>
                <?php foreach ($fungicidi as $fungicid) : ?>
                    <?php
                    $fungicid_opis = $fungicid['opis'];
                    $prvi_red = explode("\n", $fungicid_opis)[0];
                    $prvi_red = str_replace("+", "<br>+", $prvi_red);
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 ">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a href="<?= ROOT_URL ?>proizvod-detalji/<?= $fungicid['naziv_url']; ?>">
                                    <img class="primary_img" src="<?= ROOT_URL ?>betaren/<?= $fungicid['fotografija']; ?>" alt="consectetur">
                                </a>
                            </div>
                            <div class="product_content grid_content text-center">
                                <h4 class="product_name"><a href="<?= ROOT_URL ?>proizvod-detalji/<?= $fungicid['naziv_url']; ?>"><?= $fungicid['naziv']; ?></a></h4>
                                <p><?= $prvi_red ?></p>
                                <div class="add_to_cart">
                                    <a class="btn btn-primary" href="<?= ROOT_URL ?>proizvod-detalji/<?= $fungicid['naziv_url']; ?>">Pročitaj više</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
</section>

<!-- Zastita semena -->
<section class="banner_section mb-96">
    <div class="container">
        <div class="section_title mb-60">
            <a href="zastita-semena">
                <h2>Zaštita semena</h2>
            </a>
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

<!-- Regulatori rasta -->
<section class="banner_section mb-96">
    <div class="container">
        <div class="section_title mb-60">
            <a href="regulatori-rasta">
                <h2>Regulatori rasta</h2>
            </a>
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