<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$page_title = "Ščolkovo Agrohim Beograd - Početna";



include 'includes/header.php';
include 'app/classes/Proizvod.php';
include 'app/classes/Objava.php';

$proizvod = new Proizvod($conn);
$objava = new Objava($conn);

$katalog = $proizvod->getCatalog();
$istaknuti = $proizvod->getProductsIstaknuti();

$herbicidi = $proizvod->getProductByCategory("herbicidi");
$insekticidi = $proizvod->getProductByCategory("insekticidi_i_akaricidi");
$fungicidi = $proizvod->getProductByCategory("fungicidi");
$regulatori_rasta = $proizvod->getProductByCategory("regulatori_rasta");
$zastita_semena = $proizvod->getProductByCategory("zastita_semena");

$banerLevo = $proizvod->getBanerByPosition('levo');
$banerDesno = $proizvod->getBanerByPosition('desno');

$mediji = $objava->getAllVideos();

?>

<!-- Navbar -->
<?php include './includes/navbar.php'; ?>

<!-- Video -->
<section>
    <div class="row mr-0">
        <div class="col-lg-6 video-container-col">
            <div class="video-container">
                <video class="video" loop muted autoplay playsinline>
                    <source src="<?=ROOT_URL?>assets/img/Promotivni video sajt.mp4" type="video/mp4">
                </video>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="image-container">
                <a href="<?= ROOT_URL ?><?= $katalog['katalog']; ?>" target="_blank">
                    <img src="<?= ROOT_URL ?><?= $katalog['fotografija']; ?>" class="img-fluid banner-image catalog" alt="Katalog">
                </a>
            </div>
        </div>
    </div>
</section>



<!-- product section start -->
<section class="product_section mb-96 mt-5">
    <div class="container">
        <div class="product_header d-flex justify-content-between  mb-50">
            <div class="section_title">
                <h2>Istaknuti proizvodi</h2>
            </div>
            <div class="product_tab_btn d-flex justify-content-between">
                <div class="all_product">
                    <a href="proizvodi">Svi proizvodi</a>
                </div>
            </div>
        </div>

        <div class="product_container row">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="herbicidi" role="tabpanel">
                    <div class="product_slick slick_slider_activation" data-slick='{
                            "slidesToShow": 4,
                            "slidesToScroll": 1,
                            "arrows": true,
                            "dots": false,
                            "autoplay": true,
                            "speed": 300,
                            "infinite": true,
                            "responsive":[
                              {"breakpoint":992, "settings": { "slidesToShow": 3 } },
                              {"breakpoint":768, "settings": { "slidesToShow": 2 } },
                              {"breakpoint":300, "settings": { "slidesToShow": 1 } }
                             ]
                        }'>
                        <?php if (empty($istaknuti)) : ?>
                            <p>Trenutno nema istaknutih proizvoda <i class="fa-regular fa-face-frown"></i></p>
                        <?php else : ?>
                            <?php foreach ($istaknuti as $istaknut) : ?>
                                <article class="col single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a href="<?= ROOT_URL ?>proizvod-detalji/<?= $istaknut['naziv_url']; ?>">
                                                <img class="primary_img" src="<?= ROOT_URL ?><?= $istaknut['fotografija']; ?>" alt="consectetur">
                                            </a>
                                        </div>
                                        <figcaption class="product_content text-center">
                                            <h4 class="product_name"><?= $istaknut['naziv']; ?></h4>
                                            <div class="add_to_cart">
                                                <a class="btn btn-primary" href="<?= ROOT_URL ?>proizvod-detalji/<?= $istaknut['naziv_url']; ?>" data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true"
                                                    data-tippy-placement="top">Detalji</a>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            <?php endforeach ?>
                        <?php endif ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product section end -->

<!-- banner section start -->
<section class="banner_section banner_style2 mb-109">
    <div class="container">
        <div class="row banner-2">
            <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                <img src="<?= ROOT_URL ?><?=$banerLevo['fotografija']; ?>" class="img-fluid banner-image-2" alt="" style="filter: drop-shadow(0 0.2rem 0.25rem rgba(0, 0, 0, 0.2));">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 d-flex justify-content-center align-items-center">
                <img src="<?= $banerDesno['fotografija']; ?>" class="img-fluid banner-image-2" alt="" style="filter: drop-shadow(0 0.2rem 0.25rem rgba(0, 0, 0, 0.2));">
            </div>
        </div>
    </div>
</section>
<!-- banner section end -->

<!-- mediji section start -->
<section class="blog_section mb-140">
    <div class="container">
        <div class="product_header border-top d-flex justify-content-between  mb-60">
            <div class="section_title">
                <h2>Mediji</h2>
            </div>
            <div class="all_articles">
                <a href="mediji">Svi mediji</a>
            </div>
        </div>
        <div class="blog_container row">
            <div class="blog_slick slick_slider_activation" data-slick='{
                        "slidesToShow": 3,
                        "slidesToScroll": 1,
                        "arrows": false,
                        "dots": false,
                        "autoplay": true,
                        "speed": 300,
                        "infinite": true,
                        "responsive":[
                          {"breakpoint":992, "settings": { "slidesToShow": 2 } },
                          {"breakpoint":768, "settings": { "slidesToShow": 2 } },
                          {"breakpoint":576, "settings": { "slidesToShow": 1 } }
                        ]
                    }'>
                <?php if (empty($mediji)) : ?>
                    <p>Trenutno nema objava <i class="fa-regular fa-face-frown"></i></p>
                <?php else : ?>
                    <?php foreach ($mediji as $video) : ?>
                        <article class="col single_blog">
                            <figure>
                                <div class="blog_thumb">
                                    <a href="<?= ROOT_URL ?>objava-video/<?= $video['naziv_url']; ?>"><img src="<?= $video['cover']; ?>" alt=""></a>
                                </div>
                                <figcaption class="blog_content">
                                    <div class="blog_meta">
                                        <ul class="d-flex">
                                            <li><span><?= $video['datum']; ?></span></li>
                                        </ul>
                                    </div>
                                    <h3><a href="<?= ROOT_URL ?>objava-video/<?= $video['naziv_url']; ?>"><?= $video['naslov']; ?></a></h3>
                                </figcaption>
                            </figure>
                        </article>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</section>
<!-- mediji section end -->





<?php include './includes/footer.php'; ?>