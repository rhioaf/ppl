<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    $currentIndex = null;
    $kode = $_GET['kode'];
    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $index => $item){
            if($item['kodebrg'] == $kode){
                $currentIndex = $index;
            }
        }
        if(!is_null($currentIndex)){
            $harga = $_SESSION['cart'][$currentIndex]['harga'];
            $_SESSION['cart'][$currentIndex]['jumlah']++;
            $_SESSION['cart'][$currentIndex]['subtotal'] = $harga * $_SESSION['cart'][$currentIndex]['jumlah'];
        }
    }
    header('location:template.php?content=shoppingcart.php');
    exit();
?>