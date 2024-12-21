<?php

class Proizvod
{
    protected  $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createUrl($string)
    {
        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9]+/', '-', $string);
        $string = trim($string, '-');

        return $string;
    }

    public function editProduct($naziv, $naziv_url, $kategorija, $tip, $opis, $istaknut, $delovanje_preparata, $primena_preparata, $rezultati_ogleda, $fotografija, $timestamp, $id)
    {
        $sql = "UPDATE proizvod SET naziv=?, naziv_url=?, kategorija=?, tip=?, opis=?, istaknut=?, delovanje_preparata=?, primena_preparata=?, rezultati_ogleda_tekst=?, fotografija=?, timestamp=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssisssssi", $naziv, $naziv_url, $kategorija, $tip, $opis, $istaknut, $delovanje_preparata, $primena_preparata, $rezultati_ogleda, $fotografija, $timestamp, $id);
        $stmt->execute();
    }

    public function addProduct($naziv, $naziv_url, $kategorija, $tip, $opis, $istaknut, $delovanje_preparata, $primena_preparata, $rezultati_ogleda, $fotografija, $timestamp)
    {
        $sql = "INSERT INTO proizvod (naziv, naziv_url, kategorija, tip, opis, istaknut, delovanje_preparata, primena_preparata, rezultati_ogleda_tekst, fotografija, timestamp) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssisssss", $naziv, $naziv_url, $kategorija, $tip, $opis, $istaknut, $delovanje_preparata, $primena_preparata, $rezultati_ogleda, $fotografija, $timestamp);
        $stmt->execute();
    }

    public function deleteProduct($id)
    {
        $sql = "UPDATE proizvod SET obrisan=1 WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
    }

    public function addPhotos($proizvod_id, $fotografija)
    {
        $sql = "INSERT INTO rezultati_ogleda_slike(proizvod_id, fotografija) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $proizvod_id, $fotografija);
        $stmt->execute();
    }

    public function addBaner($fotografija, $pozicija) {
        $sql = "UPDATE baner SET fotografija=? WHERE pozicija=?";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            echo "<script>alert('Greška pri pripremi: " . htmlspecialchars($this->conn->error) . "');</script>";
            return false;
        }
        
        $stmt->bind_param("ss", $fotografija, $pozicija);
        
        if (!$stmt->execute()) {
            echo "<script>alert('Greška pri izvršavanju: " . htmlspecialchars($stmt->error) . "');</script>";
            return false;
        }
    
        if ($stmt->affected_rows > 0) {
            return true; // Uspešno
        } else {
            echo "<script>alert('Nije izvršena nijedna promena. Proverite da li pozicija postoji.');</script>";
            return false; // Neuspešno
        }
    }
    

    public function deletePhotoById($id)
    {
        $sql = "DELETE FROM rezultati_ogleda_slike WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getProductByCategory($kategorija)
    {
        $sql = "SELECT * FROM proizvod WHERE kategorija=? AND obrisan='0' ORDER BY naziv ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $kategorija);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductByUrl($naziv_url)
    {

        $sql = "SELECT * FROM proizvod WHERE naziv_url=? AND obrisan='0'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $naziv_url);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getBanerByPosition($pozicija)
    {

        $sql = "SELECT * FROM baner WHERE pozicija=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $pozicija);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getPhotosById($id)
    {
        $sql = "SELECT * FROM rezultati_ogleda_slike WHERE proizvod_id=? AND obrisan='0'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getBannerByPosition($pozicija)
    {
        $sql = "SELECT * FROM baner WHERE pozicija=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $pozicija);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getCatalogName()
    {
        $sql = "SELECT * FROM katalog";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Ako 'katalog' sadrži putanju, uzimamo samo ime datoteke
        if ($row && isset($row['katalog'])) {
            $row['katalog'] = basename($row['katalog']);
        }

        return $row;
    }

    public function getCatalog()
    {
        $sql = "SELECT * FROM katalog";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function updateCatalog($katalog, $fotografija, $id)
    {
        $katalogPath = "../assets/img/katalog/" . $katalog;
        $fotografijaPath = "../assets/img/katalog/" . $fotografija;
        $sql = "UPDATE katalog SET katalog=?, fotografija=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $katalogPath, $fotografijaPath, $id);
        $stmt->execute();
    }

    public function getProductsIstaknuti()
    {
        $sql = "SELECT * FROM proizvod WHERE istaknut='1' AND obrisan=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function countProductbyCategory($kategorija)
    {
        $sql = "SELECT COUNT(id) AS total FROM proizvod WHERE obrisan='0' AND kategorija=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $kategorija);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
}
