<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    $currentIndex = null;
    $kode = $_GET['kode'];
    $countItem = 0;
    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $index => $item){
            if($item['kodebrg'] == $kode){
                $currentIndex = $index;
            }
            $countItem++;
        }
        if(!is_null($currentIndex)){
            if($countItem > 1){
                $currentJumlah = $_SESSION['cart'][$currentIndex]['jumlah'];
                if($currentJumlah - 1 < 1){
                    unset($_SESSION['cart'][$currentIndex]);
                    header('location:template.php?content=shoppingcart.php');
                    exit();
                } else {
                    $harga = $_SESSION['cart'][$currentIndex]['harga'];
                    $_SESSION['cart'][$currentIndex]['jumlah']--;
                    $_SESSION['cart'][$currentIndex]['subtotal'] = $harga * $_SESSION['cart'][$currentIndex]['jumlah'];
                    header('location:template.php?content=shoppingcart.php');
                    exit();
                }
            } else {
                $currentJumlah = $_SESSION['cart'][$currentIndex]['jumlah'];
                if($currentJumlah - 1 < 1){
                    unset($_SESSION['cart']);
                    header('location:template.php?content=shoppingcart.php');
                    exit();
                } else {
                    $harga = $_SESSION['cart'][$currentIndex]['harga'];
                    $_SESSION['cart'][$currentIndex]['jumlah']--;
                    $_SESSION['cart'][$currentIndex]['subtotal'] = $harga * $_SESSION['cart'][$currentIndex]['jumlah'];
                    header('location:template.php?content=shoppingcart.php');
                    exit();
                }
            }
        }
    }
    header('location:template.php?content=shoppingcart.php');
    exit();
?>