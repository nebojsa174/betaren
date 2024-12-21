<?php
include '../app/config/config.php';
include '../app/config/database.php';
include '../app/classes/Proizvod.php';

$proizvodi = new Proizvod($conn);


if (isset($_POST['submit'])) {
    $pozicija = $_POST['pozicija'];

    // Validacija pozicije
    if ($pozicija !== 'levo' && $pozicija !== 'desno') {
        echo "<script>alert('Nevalidna pozicija.'); window.history.back();</script>";
        exit();
    }

    $fotografija = $_FILES['fotografija']['name'];
    $imageSource = $_FILES['fotografija']['tmp_name'];
    $imageDestination = "../assets/img/baneri/" . basename($fotografija);
    $imageDestination2 = "./assets/img/baneri/" . basename($fotografija);

    // Proveri tip fajla
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = $_FILES['fotografija']['type'];

    if (!in_array($fileType, $allowedTypes)) {
        echo "<script>alert('Nevalidan tip fajla. Dozvoljeni tipovi: JPEG, PNG, GIF.'); window.history.back();</script>";
        exit();
    }

    // Učitavanje slike
    if ($uploadImage = move_uploaded_file($imageSource, $imageDestination)) {
        // Dodavanje banera u bazu
        $novi_baner = $proizvodi->addBaner($imageDestination2, $pozicija);

        // Preusmeravanje        
        header("location:" . ADMIN_URL . "unos-banera.php");
        echo "<script>alert('Baner je uspešno otpremljen.'); window.history.back();</script>";
        exit();
    } else {
        echo "<script>alert('Došlo je do greške pri otpremanju slike.'); window.history.back();</script>";
        exit();
    }
}


$banerLevo = $proizvodi->getBanerByPosition('levo');
$banerDesno = $proizvodi->getBanerByPosition('desno');

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
                                    <p class="mb-3">Podaci o banerima</p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 d-flex justify-content-center align-items-center">                                        
                                        <img src=".<?= $banerLevo['fotografija']; ?>" class="img-fluid banner-image-2" alt="" style="filter: drop-shadow(0 0.2rem 0.25rem rgba(0, 0, 0, 0.2));">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 d-flex justify-content-center align-items-center">
                                        <img src=".<?= $banerDesno['fotografija']; ?>" class="img-fluid banner-image-2" alt="" style="filter: drop-shadow(0 0.2rem 0.25rem rgba(0, 0, 0, 0.2));">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Pozicija</label>
                                        <select id="pozicija" name="pozicija" class="form-control" required>
                                            <option value="default" selected disabled>-- Izaberite poziciju --</option>
                                            <option value="levo">Levo</option>
                                            <option value="desno">Desno</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Fotografija</label>
                                        <input class="form-control" type="file" name="fotografija" value="" required>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-5">
                                    <button class="btn btn-primary btn-sm ms-auto" name="submit" type="submit"><i class="fas fa-save"></i> &nbsp;IZMENI BANER</button>
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