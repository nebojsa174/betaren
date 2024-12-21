<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Stranica</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                    <?php
                    $current_page = basename($_SERVER['PHP_SELF'], '.php');

                    switch ($current_page) {
                        case 'index':
                            echo 'Početna';
                            break;
                        case 'pregled-proizvoda':
                            echo 'Pregled proizvoda';
                            break;
                        case 'unos-proizvoda':
                            echo 'Unos proizvoda';
                            break;
                        default:
                            echo 'Kontrolna tabla';
                            break;
                    }
                    ?>
                </li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">
                <?php
                $current_page = basename($_SERVER['PHP_SELF'], '.php');

                switch ($current_page) {

                    case 'index':
                        echo 'Dobrodošli na admin portal';
                        break;
                    case 'pregled-proizvoda':
                        echo 'Pregled proizvoda';
                        break;
                    case 'unos-proizvoda':
                        echo 'Unos proizvoda';
                        break;
                    default:
                        echo 'Kontrolna tabla';
                        break;
                }
                ?>
            </h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white font-weight-bold px-0 pe-none">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none"><?= isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?></span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="logout.php" class="nav-link text-white font-weight-bold p-0">
                        <i class="fa-solid fa-right-from-bracket me-sm-1 cursor-pointer"></i>
                        <span class="d-sm inline">Odjavi se</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>