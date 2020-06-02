<?php
include 'connectDb.php';
$conn = connDB();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];

    echo "<br/>";
    echo $nim."<br/>";
    echo $nama."<br/>";
    echo $umur."<br/>";
    
    $queryInput = "INSERT INTO mahasiswa (nim, nama, umur) VALUES ('".$nim."','".$nama."', '".$umur."')";
    $result = $conn->query($queryInput);
        if($result){
            echo "Added";
        } else{
            echo "Failed";  
        }
    ?>
    <html>
        <head>
            <title>PPL 2020</title>
        </head>
    </html>