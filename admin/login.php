<?php

    include '../app/config/config.php';
    include '../app/config/database.php';

    if (isset($_SESSION['userLoginStatus']) && $_SESSION['userLoginStatus'] === true) {
        header('location: ' . ADMIN_URL);
        exit();
    }

$username = isset($_SESSION['login-data']['username']) ? $_SESSION['login-data']['username'] : null;
unset($_SESSION['login-data']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/svg+xml" href="./assets/img/logo/favicon.png">
    <title>Login</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="./assets/css/style.css?v=2.0.4" rel="stylesheet" />
</head>

<body>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12"></div>
        </div>
    </div>
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-auto">
                            <div class="logo text-center">
                                <a href="<?=ROOT_URL?>">
                                    <img src="./assets/img/logo/company-logo.png" alt="" style="width: 70%;">
                                </a>
                            </div>
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-center">
                                    <h4 class="font-weight-bolder">Prijavite se</h4>
                                </div>
                                <div class="card-body">
                                    <?php if (isset($_SESSION['login'])) : ?>
                                        <div class="alert-message error text-center">
                                            <p class="mb-0">
                                                <?= $_SESSION['login']; unset($_SESSION['login']); ?>
                                            </p>
                                        </div>
                                    <?php endif ?>
                                    <form action="login-logic.php" method="POST">
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg" name="username" value="<?= $username ?>" placeholder="Korisničko ime">
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg" name="password" placeholder="Lozinka">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" name="submit" class="btn btn-lg btn-lg w-100 mt-4 mb-0 text-white" style="background-color: #04564C;">Prijavite se</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- JS Files -->
    <script src="./assets/js/core/popper.min.js"></script>
    <script src="./assets/js/core/bootstrap.min.js"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = { damping: '0.5' }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="./assets/js/dashboard.min.js?v=2.0.4"></script>
</body>

</html>
