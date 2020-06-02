<?php
    session_start();
    $list_barang = isset($_SESSION['nama_barang']) ? $_SESSION['nama_barang'] : [];
    foreach($list_barang as $list){
        echo $list . '<br>';
    }
?>