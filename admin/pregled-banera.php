<?php
  include '../app/config/config.php';
  include '../app/config/database.php';

  // Provera da li je korisnik ulogovan
  if (!isset($_SESSION['username'])) {
    header('location:' . ADMIN_URL . 'login.php');
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
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Pregled banera</h6>
              <?php
              $currentMonthNumeric = date('n');
              ?>
            </div>
            <div class="card-body px-0 pt-0 pb-2">

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

  <script>
    $(document).ready(function() {

      load_data(1);

      function load_data(page, query = '') {
        $.ajax({
          url: "fetch-pregled-proizvoda.php",
          method: "POST",
          data: {
            page: page,
            query: query
          },
          success: function(data) {
            $('#dynamic_content').html(data);
          }
        });
      }

      $(document).on('click', '.page-link', function() {
        var page = $(this).data('page_number');
        var query = $('#search_box').val();
        load_data(page, query);
      });

      $('#search_box').keyup(function() {
        var query = $('#search_box').val();
        load_data(1, query);
      });

    });
  </script>

</body>

</html>