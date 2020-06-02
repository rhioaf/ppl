<!-- Rhio Adjie Fabian - 181511064 -->
<?php
    session_start();
    if(!isset($_SESSION['username']) && !isset($_SESSION['id'])){
        header('location:login_pake_database.php?status="Anda belum login"');
        exit();
    }
    unset($_SESSION['username']);
    unset($_SESSION['id']);
    session_destroy();
    header('location:template.php?content=login.php');
?>