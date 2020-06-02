<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    $kodebrg = $_GET['kode'];
    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $index => $item){
            if($item['kodebrg'] == $kodebrg){
                if($item['jumlah'] - 1 > 0){
                    $currentJumlah = $item['jumlah'];
                    $item['jumlah'] = $currentJumlah - 1;
                    break;
                } else {
                    unset($_SESSION['cart'][$index]);
                    break;
                }
            }
        }
    }
    header("location:template.php?content=shoppingcart.php");
?>