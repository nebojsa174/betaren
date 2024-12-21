<?php

include './app/config/database.php';
include './app/classes/Objava.php';

$objava = new Objava($conn);

$naziv_url = $_GET['naziv_url'];

$objava_slika = $objava->getObjavaSlikeByUrl($naziv_url);

$page_title = "Ščolkovo Agrohim Beograd - " . $objava_slika[0]['naslov'];

$poslednje_objave = $objava->getLastPhotos();

include './includes/header.php';
?>

<!-- Navbar -->
<?php include './includes/navbar.php'; ?>

<!-- Breadcrumbs area start -->
<div class="breadcrumbs_area breadcrumbs_product">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="./">Početna</a></li>
                        <li><a href="mediji">Mediji</a></li>
                        <li><?=$objava_slika[0]['naslov'];?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumbs area end -->

<!-- Slike -->
<!-- Slike -->
<section class="banner_section mb-96">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="w3-content" style="max-width:700px">
                    <div class="carousel-main-photo">
                        <?php foreach ($objava_slika as $index => $slika): ?>
                            <img class="mySlides" src="<?= ROOT_URL ?><?= $slika['fotografija']; ?>" style="<?= $index === 0 ? 'display:block' : 'display:none'; ?>">
                        <?php endforeach; ?>
                    </div>
                    <div class="w3-row-padding w3-section">
                        <?php foreach ($objava_slika as $index => $slika): ?>
                            <div class="w3-col s4 mt-3">
                                <img class="demo w3-opacity w3-hover-opacity-off" src="<?= ROOT_URL ?><?= $slika['fotografija']; ?>" style="width:100%;cursor:pointer" onclick="currentDiv(<?= $index + 1; ?>)">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="mt-5">
                    <span><?= $objava_slika[0]['datum']; ?></span>
                    <h3><?= $objava_slika[0]['naslov']; ?></h3>
                    <p><?= $objava_slika[0]['tekst']; ?></p>
                </div>
            </div>
            <div class="col-md-12 col-xl-2">
                <div class="poslednje-objave-container">
                    <h3>Poslednje objave:</h3>
                    <?php foreach ($poslednje_objave as $objava) : ?>
                        <div class="poslednja-objava-div">
                            <span class="poslednja-objava-datum"><?=$objava['datum'];?></span>
                            <a href="<?= ROOT_URL ?>objava-slike.php?naziv_url=<?= $objava['naziv_url']; ?>" class="poslednja-objava-naslov"><?=$objava['naslov'];?></a>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    function currentDiv(n) {
        showDivs(slideIndex = n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > x.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = x.length
        }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
        }
        x[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " w3-opacity-off";
    }
</script>

<?php include './includes/footer.php'; ?>