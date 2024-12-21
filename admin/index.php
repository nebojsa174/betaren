<?php

  include '../app/config/config.php';
  include '../app/config/database.php';
  include '../app/classes/Proizvod.php';
  include '../app/classes/Objava.php';

  $proizvodi = new Proizvod($conn);
  $objave = new Objava($conn);

  $broj_herbicida = $proizvodi->countProductbyCategory("herbicidi");
  $broj_insekticida = $proizvodi->countProductbyCategory("insekticidi_i_akaricidi");
  $broj_fungicida = $proizvodi->countProductbyCategory("fungicidi");
  $broj_regulatora = $proizvodi->countProductbyCategory("regulatori_rasta");
  $broj_zastita = $proizvodi->countProductbyCategory("zastita_semena");

  $broj_slika = $objave->countPhoto();

  $broj_videa = $objave->countVideo();

  if(!isset($_SESSION['username'])) {
    header('location:' .ADMIN_URL. 'login.php');
    exit();
  }


?>

<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<?php include 'partials/header.php'; ?>
<!-- End Header -->

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>

  <!-- Sidemenu -->
  <?php include 'partials/sidemenu.php'; ?>
  <!-- End Sidemenu -->
  <main class="main-content position-relative border-radius-lg ">


    <!-- Navbar -->
    <?php include 'partials/navbar.php'; ?>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="mx-3">
        <h5 class="text-white">Ovde možete:</h5>
        <div class="align-items-center gap-4">
          <p class="text-white"><i class="fa fa-check text-success me-3"></i>Pregledati proizvode</p>
          <p class="text-white"><i class="fa fa-check text-success me-3"></i>Dodati ili obrisati proizvod</p>
          <p class="text-white"><i class="fa fa-check text-success me-3"></i>Izmeniti proizvod</p>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Broj herbicida na sajtu</p>
                    <h5 class="font-weight-bolder mt-3">
                      <?= $broj_herbicida["total"]; ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fa-solid fa-bottle-water text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Broj insekticidi i akaricidi</p>
                    <h5 class="font-weight-bolder mt-3">
                      <?= $broj_insekticida["total"]; ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fa-solid fa-bottle-water text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Broj fungicida na sajtu</p>
                    <h5 class="font-weight-bolder mt-3">
                      <?= $broj_fungicida["total"]; ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fa-solid fa-bottle-water text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Broj regulatora rasta</p>
                    <h5 class="font-weight-bolder mt-3">
                      <?= $broj_regulatora["total"]; ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fa-solid fa-bottle-water text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Broj zaštita semena</p>
                    <h5 class="font-weight-bolder mt-3">
                      <?= $broj_zastita["total"]; ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fa-solid fa-bottle-water text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Broj video objava</p>
                    <h5 class="font-weight-bolder mt-3">
                      <?= $broj_videa["total"]; ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fa-solid fa-video text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Broj foto objava</p>
                    <h5 class="font-weight-bolder mt-3">
                      <?= $broj_slika["total"]; ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fa-solid fa-image text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Footer -->
      <?php include 'partials/footer.php'; ?>
      <!-- End Footer -->
    </div>
  </main>

  <!-- Scripts -->
  <?php include 'partials/scripts.php'; ?>
  <!-- End Scripts -->
</body>

</html>