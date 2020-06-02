<?php
	$user = '';
	if(isset($_SESSION['username'])){
		$user = $_SESSION['username'];
    }
?>
<!DOCTYPE html>
    <br/>
    <br/>
    <br/>
    <h2>Selamat Datang <?php echo $user; ?>  </h2>
    <br/>
    <br/>
    <br/>