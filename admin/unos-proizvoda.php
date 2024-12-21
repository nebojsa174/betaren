<?php
include '../app/config/config.php';
include '../app/config/database.php';
include '../app/classes/Proizvod.php';

$proizvodi = new Proizvod($conn);

if (isset($_POST['submit'])) {

    // Dodavanje proizvoda *Pocetak*
    $naziv = $_POST['naziv'];
    $tip = $_POST['tip'];
    $kategorija = $_POST['kategorija'];
    $opis = $_POST['opis'];
    $istaknut = $_POST['istaknut'];    
    $delovanje_preparata = $_POST['delovanje_preparata'];
    $primena_preparata = $_POST['primena_preparata'];
    $rezultati_ogleda = $_POST['rezultati_ogleda'];

    $naziv_url = $proizvodi->createUrl($naziv);

    $fotografija = $_FILES['fotografija']['name'];
    $imageSource = $_FILES['fotografija']['tmp_name'];
    $imageDestination = "../assets/img/proizvodi/" . basename($fotografija);
    $uploadImage = move_uploaded_file($imageSource, $imageDestination);

    $timestamp = date('d.m.Y H:i');

    $novi_proizvod = $proizvodi->addProduct($naziv, $naziv_url, $kategorija, $tip, $opis, $istaknut, $delovanje_preparata, $primena_preparata, $rezultati_ogleda, $imageDestination, $timestamp);
    // Dodavanje proizvoda *Kraj*

    $proizvod_id = $conn->insert_id;

    // Dodavanje slike ogleda *Pocetak*
    if (isset($_FILES['fotografije']) && count($_FILES['fotografije']['name']) > 0) {
    $time = time();
    $totalFiles = count($_FILES['fotografije']['name']);

    for ($i = 0; $i < $totalFiles; $i++) {
        // Proverite da li je slika validna (ne prazna)
        if ($_FILES['fotografije']['name'][$i] != "") {
            $slika = $_FILES['fotografije']['name'][$i];
            $slika_tmp_name = $_FILES['fotografije']['tmp_name'][$i];
            $putanja = '../assets/img/ogledi/' . $time . '_' . $slika;

            // Premestite sliku na odgovarajuću lokaciju
            move_uploaded_file($slika_tmp_name, $putanja);

            // Dodajte putanju slike u bazu
            $nove_slike = $proizvodi->addPhotos($proizvod_id, $putanja);
        }
    }
}
    // Dodavanje slike ogleda *Kraj*

    header("location:" . ADMIN_URL . "pregled-proizvoda.php");
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
                                    <p class="mb-0">Unesi podatke o proizvodu</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-uppercase text-sm">Podaci o proizvodu</p>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Naziv</label>
                                            <input class="form-control" type="text" name="naziv" value="" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Tip</label>
                                            <input class="form-control" type="text" name="tip" value="" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Kategorija</label>
                                            <select id="kategorija" name="kategorija" class="form-control" required>
                                                <option value="default" selected disabled>-- Izaberite kategoriju --</option>
                                                <option value="fungicidi">Fungicidi</option>
                                                <option value="herbicidi">Herbicidi</option>
                                                <option value="insekticidi_i_akaricidi">Insekticidi i akaricidi</option>
                                                <option value="regulatori_rasta">Regulatori rasta</option>
                                                <option value="zastita_semena">Zaštita semena</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Istaknut na početnoj strani</label>
                                            <select id="istaknut" name="istaknut" class="form-control" required>
                                                <option value="default" selected disabled>-- Izaberite --</option>
                                                <option value="1">Da</option>
                                                <option value="0">Ne</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input"
                                                class="form-control-label">Fotografija</label>
                                            <input class="form-control" type="file" name="fotografija" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="opis"><b>Opis:</b></label><br>
                                            <textarea class="cke" name="opis"></textarea required> 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="delovanje_preparata"><b>Delovanje preparata:</b></label><br>
                                            <textarea name="delovanje_preparata"></textarea required> 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="primena_preparata"><b>Primena preparata:</b></label><br>
                                            <textarea name="primena_preparata"></textarea required> 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Rezultati ogleda:</label>
                                            <textarea class="form-control" name="rezultati_ogleda" id="" cols="30" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Rezultati ogleda - Fotografije</label>
                                            <input class="form-control" type='file' name="fotografije[]" accept="image/png, image/jpg, image/jpeg" multiple>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-5">
                                        <button class="btn btn-primary btn-sm ms-auto" name="submit" type="submit"><i class="fas fa-save"></i> &nbsp;UNESITE PROIZVOD</button>
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