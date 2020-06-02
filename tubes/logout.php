<!-- Rhio Adjie Fabian - 181511064 -->
<?php
    session_start();
    session_destroy();
    header('location:login.php?logoutstat="Berhasil Logout"');
    exit();
?>