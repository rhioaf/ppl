<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    include '../connectDb.php';
    $conn = connDb();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $kode = $_GET['kode'];
    $currentIndex = null;
    $countItem = 0;
    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $index => $item){
            if($item['kodebrg'] == $kode){
                $currentIndex = $index;
            }
            $countItem++;
        }
    }
    if(!is_null($currentIndex)){
        if($countItem > 1){
            unset($_SESSION['cart'][$currentIndex]);
            header('location:template.php?content=shoppingcart.php');
            exit();
        } else {
            unset($_SESSION['cart']);
            header('location:template.php?content=shoppingcart.php');
            exit();
        }
    }
    header('location:template.php?content=shoppingcart.php');
    exit();
?>