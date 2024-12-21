<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!--header area start-->
<header class="header_section">

    <div class="main_header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="header_container d-flex justify-content-between align-items-center">
                        <div class="canvas_open">
                            <a href="javascript:void(0)"><i class="ion-navicon"></i></a>
                        </div>
                        <div class="header_logo">
                            <a class="sticky_none" href="<?= ROOT_URL ?>"><img src="<?= ROOT_URL ?>assets/img/logo/company-logo.png" alt=""></a>
                        </div>
                        <!--main menu start-->
                        <div class="main_menu d-none d-lg-block">
                            <nav>
                                <ul class="d-flex">
                                    <li><a class="<?= ($current_page === "index.php") ? "active" : ""; ?>" href="<?= ROOT_URL ?>">Početna</a> </li>
                                    <li><a class="<?= in_array($current_page, ['proizvodi.php', 'herbicidi.php', 'fungicidi.php', 'insekticidi-i-akaricidi.php', 'regulatori-rasta.php', 'zastita-semena.php', 'proizvod-detalji.php']) ? 'active' : ''; ?>" href="<?= ROOT_URL ?>proizvodi">Proizvodi</a>
                                        <ul class="sub_menu">
                                            <li><a href="<?= ROOT_URL ?>herbicidi">Herbicidi</a></li>
                                            <li><a href="<?= ROOT_URL ?>insekticidi-i-akaricidi">Insekticidi i akaricidi</a></li>
                                            <li><a href="<?= ROOT_URL ?>fungicidi">Fungicidi</a></li>
                                            <li><a href="<?= ROOT_URL ?>zastita-semena">Zaštita semena</a></li>
                                            <li><a href="<?= ROOT_URL ?>regulatori-rasta">Regulatori rasta</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="<?= ($current_page === "o-kompaniji.php") ? "active" : ""; ?>" href="<?= ROOT_URL ?>o-kompaniji">O kompaniji</a></li>
                                    <li><a class="<?= in_array($current_page, ['mediji.php', 'objava-slike.php', 'objava-video.php']) ? "active" : ""; ?>" href="<?= ROOT_URL ?>mediji">Mediji</a></li>
                                    <li><a class="<?= ($current_page === "kontakt.php") ? "active" : ""; ?>" href="<?= ROOT_URL ?>kontakt">Kontakt</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header_account">
                            <ul class="d-flex">
                                <li class="header_search">
                                    <a href="https://betaren.ru/" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 32">
                                        <path fill="#1435a1" d="M1 11H31V21H1z"></path>
                                        <path d="M5,4H27c2.208,0,4,1.792,4,4v4H1v-4c0-2.208,1.792-4,4-4Z" fill="#fff"></path>
                                        <path d="M5,20H27c2.208,0,4,1.792,4,4v4H1v-4c0-2.208,1.792-4,4-4Z" transform="rotate(180 16 24)" fill="#c53a28"></path>
                                        <path d="M27,4H5c-2.209,0-4,1.791-4,4V24c0,2.209,1.791,4,4,4H27c2.209,0,4-1.791,4-4V8c0-2.209-1.791-4-4-4Zm3,20c0,1.654-1.346,3-3,3H5c-1.654,0-3-1.346-3-3V8c0-1.654,1.346-3,3-3H27c1.654,0,3,1.346,3,3V24Z" opacity=".15"></path>
                                        <path d="M27,5H5c-1.657,0-3,1.343-3,3v1c0-1.657,1.343-3,3-3H27c1.657,0,3,1.343,3,3v-1c0-1.657-1.343-3-3-3Z" fill="#fff" opacity=".2"></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="preloader">
        <img src="<?= ROOT_URL ?>assets/img/logo/company-logo.png" alt="Logo" class="preloader-logo">
    </div>

</header>
<!--header area end-->