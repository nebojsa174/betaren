<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header text-center">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="<?= ADMIN_URL ?>">
            <img src="./assets/img/logo/company-logo.png" class="navbar-brand-img h-100" alt="main_logo">
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link <?= ($current_page === '<?= ROOT_URL?>') ? 'active' : ''; ?>" href="<?= ADMIN_URL ?>">
                    <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-house text-primary opacity-10 text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Početna</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Proizvodi</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page === 'pregled-proizvoda.php') ? 'active' : ''; ?>" href="<?= ADMIN_URL ?>pregled-proizvoda.php">
                    <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-book-open text-primary opacity-10 text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pregled proizvoda</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page === 'unos-proizvoda.php') ? 'active' : ''; ?>" href="<?= ADMIN_URL ?>unos-proizvoda.php">
                    <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-arrow-up-from-bracket text-primary opacity-10 text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Unos proizvoda</span>
                </a>

            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Mediji</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page === 'pregled-medija-slike.php') ? 'active' : ''; ?>" href="<?= ADMIN_URL ?>pregled-medija-slike.php">
                    <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-list text-primary opacity-10 text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pregled medija - slike</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page === 'unos-objave-slike.php') ? 'active' : ''; ?>" href="<?= ADMIN_URL ?>unos-objave-slike.php">
                    <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-image text-primary opacity-10 text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Unos objave - slike</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page === 'pregled-medija-video.php') ? 'active' : ''; ?>" href="<?= ADMIN_URL ?>pregled-medija-video.php">
                    <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-list text-primary opacity-10 text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Pregled medija - video</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page === 'unos-objave-video.php') ? 'active' : ''; ?>" href="<?= ADMIN_URL ?>unos-objave-video.php">
                    <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-video text-primary opacity-10 text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Unos objave - video</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Baneri</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page === 'unos-banera.php') ? 'active' : ''; ?>" href="<?= ADMIN_URL ?>unos-banera.php">
                    <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-file-image text-primary opacity-10 text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Izmeni baner</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Katalog</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($current_page === 'katalog.php') ? 'active' : ''; ?>" href="<?= ADMIN_URL ?>katalog.php">
                    <div class="icon icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-book -from-bracket text-primary opacity-10 text-lg"></i>
                    </div>
                    <span class="nav-link-text ms-1">Izmeni katalog</span>
                </a>
            </li>
        </ul>
    </div>
</aside>