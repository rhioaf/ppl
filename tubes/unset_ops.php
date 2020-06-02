<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    $msg;
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    unset($_SESSION['cart']);
    header("location:template.php?content=shoppingcart.php&success=".$msg);
    exit();
?>