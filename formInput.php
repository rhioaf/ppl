<?php
include 'connectDb.php';
$conn = connDB();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
<html>
    <head>
        <title>PPL 2020</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script>
            function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
        </script>
    </head>
    <div class="container">
        <h2 class="text-center text-highlight"" >Form Input</h2>
        <form class="form-group" method="post" action="simpanDb.php">
            <label>Nim</label>
            <input type="text" class="form-control" id="nim" name="nim" minLength="1" maxLength="9" onKeyPress="return hanyaAngka(event)"/>
            <label>Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" minLength="1" maxLength="40" />
            <label>Umur</label>
            <input type="text" class="form-control" id="umur" name="umur" minLength="1" maxLength="2" onKeyPress="return hanyaAngka(event)"/>
            <br />
            <button class="btn btn-success" type="submit">Submit</button>
        </form>
    </div>
</html>