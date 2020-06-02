<?php
    function connDb(){
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPass = "";
        $db = "dbbarang";
        $conn = new mysqli($dbHost, $dbUser, $dbPass, $db) or die("Connect failed : $s\n". $conn->error);
        return $conn;
    }

    function connClose($conn){
        return $conn->close();
    }
?>