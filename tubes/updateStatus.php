<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php
    include '../connectDb.php';
    $conn = connDb();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $kode = $_GET['kode'];
    $key = $_GET['key'];
    switch($key)
    {
        case 0 :    $query = "UPDATE penjualan SET status=1 WHERE id=".$kode;
                    $result = $conn->query($query);
                    if($result){
                        header('location:templateAdmin.php?content=admin.php');
                        exit();
                    }
                    break;
        case 1 :    $query = "UPDATE penjualan SET status=2 WHERE id=".$kode;
                    $result = $conn->query($query);
                    if($result){
                        header('location:templateAdmin.php?content=admin.php');
                        exit();
                    }
                    break;
    }
?>