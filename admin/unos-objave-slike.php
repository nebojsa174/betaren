<?php
include '../app/config/config.php';
include '../app/config/database.php';
include '../app/classes/Objava.php';

$objava = new Objava($conn);


if (isset($_POST['submit'])) {

    $naslov = $_POST['naslov'];
    $tekst = $_POST['tekst'];

    $datum = date('d.m.Y');

    $naziv_url = $objava->createUrl($naslov);

    $nova_objava = $objava->addPost($naziv_url, $datum, $naslov, $tekst);

    //Dodavanje slika u posebnu tabelu *Pocetak*
    $objava_id = $conn->insert_id;

    $time = time();
    $totalFiles = count($_FILES['fotografije']['name']);

    for ($i = 0; $i < $totalFiles; $i++) {
        $slika = $_FILES['fotografije']['name'][$i];
        $slika_tmp_name = $_FILES['fotografije']['tmp_name'][$i];
        $putanja = '../assets/img/mediji/slike/' . $time . '_' . $slika;
        $photo_url = './assets/img/mediji/slike/' . $time . '_' . $slika;

        move_uploaded_file($slika_tmp_name, $putanja);
        $nove_slike = $objava->addPhotos($objava_id, $photo_url);
    }
    //Dodavanje slika u posebnu tabelu *Kraj*
}


?>

<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<?php include 'partials/header.php'; ?>
<!-- End Header -->

<body class="g-sidenav-show bg-gray-100">
    <div class="position-absolute w-100 min-height-300 top-0"
        style="background-image: url('<?=ROOT_URL?>assets/img/kompanija/kompanija1.jpg'); background-size: cover; background-position: center;">
        <span class="mask bg-primary opacity-6"></span>
    </div>

    <!-- Sidemenu -->
    <?php include 'partials/sidemenu.php'; ?>
    <!-- End Sidemenu -->

    <div class="main-content position-relative max-height-vh-100 h-100">
        <div class="container-fluid py-4">
            <div class="row">
                <form method="POST" action="" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-3">Unesite novu objavu sa slikama</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Unesite fotografije</label>
                                            <input class="form-control" type='file' name="fotografije[]" accept="image/png, image/jpg, image/jpeg" required multiple>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Naslov objave:</label>
                                            <input class="form-control" type="text" name="naslov" value="" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="opis"><b>Tekst objave:</b></label><br>
                                            <textarea class="cke" name="tekst"></textarea required> 
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-5">
                                        <button class="btn btn-primary btn-sm ms-auto" name="submit" type="submit"><i class="fas fa-save"></i> &nbsp;UNESITE OBJAVU</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Footer -->
        <?php include 'partials/footer.php'; ?>
        <!-- End Footer -->
    </div>
    </div>
    <!-- Scripts -->
    <?php include 'partials/scripts.php'; ?>
    <!-- End Scripts -->
</body>

</html>