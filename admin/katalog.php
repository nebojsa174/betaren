<?php
include '../app/config/config.php';
include '../app/config/database.php';
include '../app/classes/Proizvod.php';

$proizvodi = new Proizvod($conn);

$katalog = $proizvodi->getCatalog();
$id = $katalog['id'];
$katalog_naziv = $proizvodi->getCatalogName();

if (isset($_POST['submit'])) {

    $katalog = $_FILES['katalog']['name'];
    $pdfSource = $_FILES['katalog']['tmp_name'];
    $pdfDestination = "../assets/img/katalog/" . basename($katalog);
    $uploadKatalog = move_uploaded_file($pdfSource, $pdfDestination);

    $fotografija = $_FILES['fotografija']['name'];
    $imageSource = $_FILES['fotografija']['tmp_name'];
    $imageDestination = "../assets/img/katalog/" . basename($fotografija);
    $uploadImage = move_uploaded_file($imageSource, $imageDestination);

    $novi_katalog = $proizvodi->updateCatalog($katalog, $fotografija, $id);

    header("location:" . ADMIN_URL);
    exit();
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
                                    <p class="mb-0">Podaci o katalogu</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-12 mb-3 d-flex gap-3 align-items-center">
                                        <i class="fa-solid fa-file-pdf pdf-ikonica"></i>
                                        <a href="<?= ROOT_URL ?><?= $katalog['katalog']; ?>" target="_blank" class="katalog-link">
                                            <span><?= $katalog_naziv['katalog']; ?></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p class="text-uppercase text-sm mt-3">Izmeni katalog</p>
                                        <label for="example-text-input"
                                            class="form-control-label">Katalog</label>
                                        <input class="form-control" type="file" name="katalog" value="" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input"
                                            class="form-control-label">Fotografija</label>
                                        <input class="form-control" type="file" name="fotografija" value="" required>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-5">
                                    <button class="btn btn-primary btn-sm ms-auto" name="submit" type="submit"><i class="fas fa-save"></i> &nbsp;UNESITE KATALOG</button>
                                </div>

                            </div>

                        </div>
                    </div>
            </div>
            </form>
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