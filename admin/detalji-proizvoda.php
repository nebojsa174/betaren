<?php
include '../app/config/config.php';
include '../app/config/database.php';
include '../app/classes/Proizvod.php';

$proizvodi = new Proizvod($conn);

$naziv_url = $_GET['naziv_url'];

$proizvod = $proizvodi->getProductByUrl($naziv_url);

$id = $proizvod['id'];

$rezultati_ogleda_slike = $proizvodi->getPhotosById($id);

if (isset($_POST['submit'])) {

    // Izmena proizvoda *Pocetak*

    $naziv = $_POST['naziv'];
    $tip = $_POST['tip'];
    $kategorija = $_POST['kategorija'];
    $opis = $_POST['opis'];
    $istaknut = $_POST['istaknut'];
    $delovanje_preparata = $_POST['delovanje_preparata'];
    $primena_preparata = $_POST['primena_preparata'];
    $rezultati_ogleda = $_POST['rezultati_ogleda'];

    $naziv_url = $proizvodi->createUrl($naziv);

    if (isset($_FILES['fotografija']) && $_FILES['fotografija']['error'] == UPLOAD_ERR_OK) {
        $fotografija = $_FILES['fotografija']['name'];
        $imageSource = $_FILES['fotografija']['tmp_name'];
        $imageDestination = "../assets/img/proizvodi/" . basename($fotografija);
        $uploadImage = move_uploaded_file($imageSource, $imageDestination);
    } else {
        $imageDestination = $proizvod['fotografija'];
    }

    $timestamp = date('d.m.Y H:i');

    $izmenjeni_proizvod = $proizvodi->editProduct($naziv, $naziv_url, $kategorija, $tip, $opis, $istaknut, $delovanje_preparata, $primena_preparata, $rezultati_ogleda, $imageDestination, $timestamp, $id);

    // Izmena proizvoda *Kraj*

    // Dodavanje nove fotografije *Pocetak*

    if (isset($_FILES['fotografije']) && !empty($_FILES['fotografije']['name'][0])) {
        $time = time();
        $totalFiles = count($_FILES['fotografije']['name']);
    
        for ($i = 0; $i < $totalFiles; $i++) {
            if ($_FILES['fotografije']['error'][$i] == UPLOAD_ERR_OK) {
                $slika = $_FILES['fotografije']['name'][$i];
                $slika_tmp_name = $_FILES['fotografije']['tmp_name'][$i];
                $putanja = '../assets/img/ogledi/' . $time . '_' . basename($slika);
    
                if (move_uploaded_file($slika_tmp_name, $putanja)) {
                    $nove_slike = $proizvodi->addPhotos($id, $putanja);
                }
            }
        }
    }

    // Dodavanje nove fotografije *Kraj*   

    header("location:" . ADMIN_URL . "pregled-proizvoda.php");
    exit();
}

if(isset($_POST['delete'])){
    $obrisani_proizvod = $proizvodi->deleteProduct($id);
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

        <!-- Header proizvoda *Pocetak* -->
        <div class="card shadow-lg mx-4 card-profile-bottom">
            <div class="card-body p-3">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="<?= ROOT_URL ?>betaren/<?= $proizvod['fotografija']; ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                <?= $proizvod['naziv']; ?>
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm" style="text-transform: uppercase;">
                                <?= $proizvod['tip']; ?>
                            </p>
                            <p class="mb-0 text-xs">
                                Datum i vreme unosa u bazu: <?= $proizvod['timestamp']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header proizvoda *Kraj* -->

        <div class="container-fluid py-4">
            <div class="row">
                <form method="POST" action="" enctype="multipart/form-data" onsubmit="return confirm('Da li ste sigurni?');">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">Izmenite podatke o proizvodu</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-uppercase text-sm">Podaci o proizvodu</p>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Naziv</label>
                                            <input class="form-control" type="text" name="naziv" value="<?= $proizvod['naziv']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Tip</label>
                                            <input class="form-control" type="text" name="tip" value="<?= $proizvod['tip']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Kategorija</label>
                                            <select id="kategorija" name="kategorija" class="form-control" required>

                                                <?php
                                                switch ($proizvod['kategorija']) {
                                                    case "fungicidi":
                                                        echo "
                                                            <option value='fungicidi' selected>Fungicidi</option>
                                                            <option value='herbicidi'>Herbicidi</option>
                                                            <option value='insekticidi_i_akaricidi'>Insekticidi i akaricidi</option>
                                                            <option value='regulatori_rasta'>Regulatori rasta</option>
                                                            <option value='zastita_semena'>Zaštita semena</option>
                                                            ";
                                                        break;

                                                    case "herbicidi":
                                                        echo "
                                                            <option value='fungicidi'>Fungicidi</option>
                                                            <option value='herbicidi' selected>Herbicidi</option>
                                                            <option value='insekticidi_i_akaricidi'>Insekticidi i akaricidi</option>
                                                            <option value='regulatori_rasta'>Regulatori rasta</option>
                                                            <option value='zastita_semena'>Zaštita semena</option>
                                                            ";
                                                        break;

                                                    case "insekticidi_i_akaricidi":
                                                        echo "
                                                            <option value='fungicidi'>Fungicidi</option>
                                                            <option value='herbicidi'>Herbicidi</option>
                                                            <option value='insekticidi_i_akaricidi' selected>Insekticidi i akaricidi</option>
                                                            <option value='regulatori_rasta'>Regulatori rasta</option>
                                                            <option value='zastita_semena'>Zaštita semena</option>
                                                            ";
                                                        break;

                                                    case "regulatori_rasta":
                                                        echo "
                                                            <option value='fungicidi'>Fungicidi</option>
                                                            <option value='herbicidi'>Herbicidi</option>
                                                            <option value='insekticidi_i_akaricidi'>Insekticidi i akaricidi</option>
                                                            <option value='regulatori_rasta' selected>Regulatori rasta</option>
                                                            <option value='zastita_semena'>Zaštita semena</option>
                                                            ";
                                                        break;

                                                    case "zastita_semena":
                                                        echo "
                                                            <option value='fungicidi'>Fungicidi</option>
                                                            <option value='herbicidi'>Herbicidi</option>
                                                            <option value='insekticidi_i_akaricidi'>Insekticidi i akaricidi</option>
                                                            <option value='regulatori_rasta'>Regulatori rasta</option>
                                                            <option value='zastita_semena' selected>Zaštita semena</option>
                                                            ";
                                                        break;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Istaknut</label>
                                            <select id="istaknut" name="istaknut" class="form-control" required>
                                                <?php
                                                switch ($proizvod['istaknut']) {
                                                    case "1":
                                                        echo "
                                                            <option value='1' selected>Da</option>
                                                            <option value='0'>Ne</option>
                                                            ";
                                                        break;

                                                    case "0":
                                                        echo "
                                                            <option value='1'>Da</option>
                                                            <option value='0' selected>Ne</option>
                                                            ";
                                                        break;                                                                                                        
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Fotografija:</label>
                                            <input class="form-control" type="file" name="fotografija" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="opis"><b>Opis:</b></label><br>
                                            <textarea name="opis"><?= $proizvod['opis']; ?></textarea required> 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="delovanje_preparata"><b>Delovanje preparata:</b></label><br>
                                            <textarea name="delovanje_preparata"><?= $proizvod['delovanje_preparata']; ?></textarea required> 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="primena_preparata"><b>Primena preparata:</b></label><br>
                                            <textarea name="primena_preparata"><?= $proizvod['primena_preparata']; ?></textarea required> 
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Rezultati ogleda:</label>
                                            <textarea class="form-control" name="rezultati_ogleda" id="" cols="30" rows="4"><?= $proizvod['rezultati_ogleda_tekst']; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12" id="rezultati-ogleda">
                                        <div class="rezultati-ogleda-slike">
                                            <div class="row">
                                                <?php foreach ($rezultati_ogleda_slike as $slika) : ?>
                                                    <div class="slika-container col-md-2 d-flex flex-column justify-content-center align-items-center">
                                                        <img src="<?= ROOT_URL ?>betaren/<?= $slika['fotografija']; ?>" alt="" class="img-fluid">
                                                        <button class="btn btn-primary pt-2 mt-2 obrisi-sliku" data-id="<?= $slika['id']; ?>">
                                                            <i class="fa-solid fa-trash-can"></i> Obriši
                                                        </button>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Rezultati ogleda - Unesite nove fotografije</label>
                                            <input class="form-control" type='file' name="fotografije[]" accept="image/png, image/jpg, image/jpeg" multiple>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-5">
                                        <button class="btn btn-primary btn-sm ms-auto" name="submit" type="submit" style="margin-right: 15px;"><i class="fas fa-save"></i> &nbsp;SAČUVAJ IZMENE</button>
                                        <button class="btn btn-danger btn-sm ms-auto" name="delete" type="submit" style="margin-right: 15px;"><i class="fa-solid fa-trash-can"></i> &nbsp;OBRIŠI PROIZVOD</button>                                        
                                        <a href="./pregled-proizvoda.php" class="btn btn-secondary btn-sm ms-auto"><i class="fa-solid fa-xmark"></i> &nbsp;OTKAŽI</a>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.obrisi-sliku', function(e) {
            e.preventDefault(); 
            const slikaId = $(this).data('id');
            const $thisButton = $(this); 

            if (confirm('Da li ste sigurni da želite da obrišete ovu sliku?')) {
                $.ajax({
                    url: 'obrisi_sliku.php',
                    type: 'POST',
                    data: {
                        id: slikaId
                    },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            // Ukloni div sa slikom
                            $thisButton.closest('.slika-container').remove();
                        } else {
                            alert(result.message);
                        }
                    },
                    error: function() {
                        alert('Došlo je do greške. Pokušajte ponovo.');
                    }
                });
            }
        });
    </script>


    <!-- End Scripts -->
</body>

</html>