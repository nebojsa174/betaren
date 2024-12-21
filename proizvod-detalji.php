<?php

include './app/config/database.php';
include './app/classes/Proizvod.php';

$proizvodi = new Proizvod($conn);

$naziv_url = $_GET['naziv_url'];

$proizvod = $proizvodi->getProductByUrl($naziv_url);

$page_title = "Ščolkovo Agrohim Beograd -  " . $proizvod['naziv'];

$id = $proizvod['id'];

$rezultati_ogleda_slike = $proizvodi->getPhotosById($id);

include './includes/header.php';

$link = '';
switch ($proizvod['kategorija']) {
    case 'herbicidi':
        $link = ROOT_URL.'herbicidi';
        break;
    case 'insekticidi_i_akaricidi':
        $link = ROOT_URL.'insekticidi-i-akaricidi';
        break;
    case 'fungicidi':
        $link = ROOT_URL.'fungicidi';
        break;
    case 'regulatori_rasta':
        $link = ROOT_URL.'regulatori-rasta';
        break;
    case 'zastita_semena':
        $link = ROOT_URL.'zastita-semena';
        break;
    default:
        $link = ROOT_URL;
        break;
}

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
                        <li><a href="<?= ROOT_URL?>proizvodi">Proizvodi</a></li>
                        <li><a href="<?= $link ?>"><?= ucfirst(str_replace('_', ' ', $proizvod['kategorija'])); ?></a></li>
                        <li><?= $proizvod['naziv']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--product details start-->
<section class="product_details mb-135">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <img src="<?= ROOT_URL ?>betaren/<?= $proizvod['fotografija']; ?>" alt="">
            </div>

            <div class="col-lg-8 col-md-8">
                <div class="product_d_right">
                    <h1 class="font-weight-bold mb-3"><?= $proizvod['naziv']; ?></h1>
                    <h4 class="mb-3"><?= $proizvod['tip']; ?></h4>

                    <div class="opis-proizvoda">
                        <p><?= $proizvod['opis']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--product details end-->

<!--product info start-->
<div class="product_d_info mb-118">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_d_inner">
                    <div class="product_info_button border-bottom">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#delovanje-preparata" role="tab" aria-controls="delovanje-preparata" aria-selected="false">Delovanje preparata</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#primena-preparata" role="tab" aria-controls="primena-preparata" aria-selected="false">Primena preparata</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#rezultati-ogleda" role="tab" aria-controls="rezultati-ogleda" aria-selected="false">Rezultati ogleda</a>
                            </li>

                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="delovanje-preparata" role="tabpanel">
                            <div class="product_info_content">
                                <div class="delovanje-preparata">
                                    <p><?= $proizvod['delovanje_preparata']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="primena-preparata" role="tabpanel">
                            <div class="product_d_table primena-preparata">
                                <p><?= $proizvod['primena_preparata']; ?></p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="rezultati-ogleda" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-8 rezultati-ogleda-slike d-flex flex-wrap">
                                    <?php foreach ($rezultati_ogleda_slike as $slika) : ?>
                                        <a href="<?= ROOT_URL ?>betaren/<?= $slika['fotografija']; ?>" data-lightbox="models" data-title>
                                            <img src="<?= ROOT_URL ?>betaren/<?= $slika['fotografija']; ?>" alt="" class="img-fluid">
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                                <div class="col-lg-4">
                                    <p><?= $proizvod['rezultati_ogleda_tekst']; ?></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--product info end-->

<?php include './includes/footer.php'; ?>