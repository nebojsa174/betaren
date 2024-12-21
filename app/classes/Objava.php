<?php

class Objava
{

    protected  $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getObjavaSlike()
    {

        $sql = "SELECT 
            objava_slika.id AS objava_id,
            objava_slika.naziv_url,
            objava_slika.datum,
            objava_slika.naslov,
            objava_slika.tekst,
            MIN(slika.fotografija) AS prva_slika
        FROM 
            objava_slika
        LEFT JOIN 
            slika ON objava_slika.id = slika.objava_id
        WHERE obrisan=0
        GROUP BY 
            objava_slika.id, objava_slika.naziv_url, objava_slika.datum, objava_slika.naslov, objava_slika.tekst;

    ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getObjavaVideoLimit()
    {
        $sql = "SELECT * FROM objava_videa, video WHERE objava_videa.id = video.objava_id WHERE obrisan=0 ORDER BY objava_videa.id DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getObjavaSlikeByUrl($naziv_url)
    {

        $sql = "SELECT * FROM objava_slika, slika WHERE objava_slika.id = slika.objava_id AND objava_slika.naziv_url=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $naziv_url);
        $stmt->execute();

        $result = $stmt->get_result();
        $images = [];

        while ($row = $result->fetch_assoc()) {
            $images[] = $row;
        }

        return $images;
    }

    public function getLastPhotos()
    {

        $sql = "SELECT * FROM objava_slika WHERE obrisan=0 ORDER BY datum DESC LIMIT 3";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllVideos()
    {

        $sql = "SELECT * FROM objava_videa WHERE obrisan=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getVideoByUrl($naziv_url)
    {

        $sql = "SELECT * FROM objava_videa WHERE naziv_url=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $naziv_url);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getLastVideos()
    {

        $sql = "SELECT * FROM objava_videa WHERE obrisan=0 ORDER BY datum DESC LIMIT 3";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createUrl($string)
    {
        // Replace Serbian characters with their equivalents
        $replacements = [
            'š' => 's',
            'đ' => 'dj',
            'ž' => 'z',
            'č' => 'c',
            'ć' => 'c'
        ];
        $string = strtr($string, $replacements);
    
        $string = strtolower($string);
    
        $string = preg_replace('/[^a-z0-9]+/', '-', $string);
    
        $string = trim($string, '-');
    
        return $string;
    }


    public function addPhotos($objava_id, $fotografija)
    {
        $sql = "INSERT INTO slika(objava_id, fotografija) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $objava_id, $fotografija);
        $stmt->execute();
    }

    public function addPost($naziv_url, $datum, $naslov, $tekst)
    {
        $sql = "INSERT INTO objava_slika (naziv_url, datum, naslov, tekst) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $naziv_url, $datum, $naslov, $tekst);
        $stmt->execute();
    }

    public function addVideo($video, $cover, $naziv_url, $datum, $naslov, $tekst)
    {
        $sql = "INSERT INTO objava_videa(video, cover, naziv_url, datum, naslov, tekst) VALUES (?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $video, $cover, $naziv_url, $datum, $naslov, $tekst);
        $stmt->execute();
    }

    public function deleteSlike($id)
    {
        $sql = "UPDATE objava_slika SET obrisan=1 WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function deleteVidea($id)
    {
        $sql = "UPDATE objava_videa SET obrisan=1 WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function countPhoto()
    {
        $sql = "SELECT COUNT(id) AS total FROM objava_slika WHERE obrisan='0'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function countVideo()
    {
        $sql = "SELECT COUNT(id) AS total FROM objava_videa WHERE obrisan='0'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
