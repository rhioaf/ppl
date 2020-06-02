<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    unset($_SESSION['cart']);
    header("location:template.php?content=shoppingcart.php");
    exit();
?>