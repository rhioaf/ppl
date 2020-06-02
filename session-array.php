<?php 
    session_start();
    session_destroy();
    session_start();
    $_SESSION['nama_barang'][0] = "Pensil";
    $_SESSION['nama_barang'][1] = "Kertas";
    $_SESSION['nama_barang'][2] = "Penghapus";
?>