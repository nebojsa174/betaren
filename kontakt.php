<?php 

$page_title = "Ščolkovo Agrohim Beograd - Kontakt";
include './includes/header.php'; ?>

<!-- Navbar -->
<?php include './includes/navbar.php'; ?>

<?php
if (isset($_POST['submit'])) {
    
    $ime = $_POST['ime'];
    $email = $_POST['email'];
    $naslov = $_POST['naslov'];
    $poruka = $_POST['poruka'];

    
    $to = 'office@betaren.rs';
    $subject = $naslov;
    $message = "Ime: $ime\nEmail: $email\nPoruka: $poruka";
    $headers = "From: $ime <$email>";

    // Slanje emaila
    if (mail($to, $subject, $message, $headers)) {
        echo '<script>alert("Poruka je uspešno poslata. Uskoro će Vas neko kontaktirati! Vaš Betaren.");</script>';
    } else {
        echo '<script>alert("Došlo je do greške prilikom slanja poruke, pokušajte ponovo!.");</script>';
    }
}
?>


<!--breadcrumbs area start-->
<div class="breadcrumbs_area breadcrumbs_product">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <ul>
                        <li><a href="./">Početna</a></li>
                        <li><a href="kontakt.php">Kontakt</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!-- Contact Start -->
<div class="container-fluid contact">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-xl-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <div class="bg-light rounded p-5 mb-5">
                        <h4 class="mb-4 font-weight-bold" style="color: #04564c;">Kontaktirajte nas</h4>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="contact-add-item">
                                    <div class="contact-icon  mb-4">
                                        <i class="fas fa-city fa-2x" style="color: #04564c;"></i>
                                    </div>
                                    <div>
                                        <h4>Adresa</h4>
                                        <p class="mb-0">Omladinskih brigada 90V (6. sprat), 11 070 Novi Beograd</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-add-item">
                                    <div class="contact-icon  mb-4">
                                        <i class="fas fa-address-card fa-2x" style="color: #04564c;"></i>
                                    </div>
                                    <div>
                                        <h4>Ostale informacije</h4>
                                        <p class="mb-0">Matični broj: 21412651</p>
                                        <p class="mb-0">PIB: 111003833 </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-add-item">
                                    <div class="contact-icon  mb-4">
                                        <i class="fas fa-at fa-2x" style="color: #04564c;"></i>
                                    </div>
                                    <div>
                                        <h4>Email</h4>
                                        <p class="mb-0">office@betaren.rs</p>
                                        <p class="mb-0">agrochim@betaren.rs</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="contact-add-item">
                                    <div class="contact-icon  mb-4">
                                        <i class="fas fa-phone fa-2x" style="color: #04564c;"></i>
                                    </div>
                                    <div>
                                        <h4>Telefon</h4>
                                        <p class="mb-0">+381 63 603 705</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="contact-add-item">
                                    <div class="contact-icon  mb-4">
                                        <i class="fas fa-users fa-2x" style="color: #04564c;"></i>
                                    </div>
                                    <div>
                                        <h4>Kontakt informacije</h4>
                                        <p class="mb-0">Generalni direktor: Goran Grebović </p>
                                        <p class="mb-0">Regionalni menadžer prodaje: Nemanja Grebović</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light p-5 rounded h-100 wow fadeInUp" data-wow-delay="0.2s">
                        <h4 class="">Kontakt forma</h4>
                        <p class="mb-4">Ako imate bilo kakav upit ili želite da zakažete sastanak sa nama, popunite formu</p>
                        <form method="POST" action="">
                            <div class="row g-4">
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0" id="name" placeholder="Vaše ime" name="ime" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-xl-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control border-0" id="email" placeholder="Vaš email" name="email" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control border-0" id="subject" placeholder="Naslov" name="naslov" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control border-0" placeholder="Napišite poruku" id="message" name="poruka" style="height: 160px" required></textarea>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100" name="submit">Pošalji poruku</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                <div class="rounded h-100">
                    <iframe class="rounded h-100 w-100"
                        style="height: 400px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.4457715669664!2d20.3967197!3d44.812482499999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a6f81e45a4dbb%3A0x73bf5bace75a029f!2sOmladinskih%20brigada%2090v%2C%20Beograd%2011000!5e0!3m2!1sen!2srs!4v1727359278355!5m2!1sen!2srs"
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<?php include './includes/footer.php'; ?>