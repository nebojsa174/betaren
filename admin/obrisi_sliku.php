<?php
include '../app/config/config.php';
include '../app/config/database.php';
include '../app/classes/Proizvod.php';

$proizvodi = new Proizvod($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $success = $proizvodi->deletePhotoById($id);
    
    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Došlo je do greške prilikom brisanja.']);
    }
}
?>
