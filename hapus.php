<?php
    include 'connectDb.php';
    $conn = connDB();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    if(isset($_GET["nim"])){
        $nim = $_GET["nim"];
        $getDataMahasiswa = "SELECT * FROM mahasiswa WHERE nim='$nim'";
        $results = $conn->query($getDataMahasiswa);
        while($result = $results->fetch_assoc()){
            $namaFile = $result["namafilefoto"];
            $locationFile = "fotomahasiswa/".$namaFile;
            unlink($locationFile);
        }
        $queryDelete = "DELETE FROM mahasiswa WHERE nim='$nim'";
        $finalResult = $conn->query($queryDelete);
        if($finalResult){
            header("location:template.php?content=display_dan_viewdetail.php"); 
        }
    }
?>
