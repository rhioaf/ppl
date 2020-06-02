<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <?php
        include 'connectDb.php';
        $conn = connDB();
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        if(isset($_POST["submit"])){
            $nim = $_POST["nim"];
            $nama = $_POST["nama"];
            $umur = $_POST["umur"];
            $namaGambar = $_FILES["gambar"]["name"];
            $sizeGambar = $_FILES["gambar"]["size"];
            $fileGambar = $_FILES["gambar"]["tmp_name"];
            if($sizeGambar < 1044070){
                move_uploaded_file($fileGambar, 'fotomahasiswa/'.$namaGambar);
                $queryInput = "INSERT INTO mahasiswa VALUES ('".$nim."', '".$nama."', '".$umur."','".$namaGambar."') ";
                $result = $conn->query($queryInput);
                if($result){
                    header("location:template.php?content=display_dan_viewdetail.php");
                }
            }
        }
    ?>
    <style>
        .card{
            border-color: #000000;
        }
    </style>
    <script>
        function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))   return false;
		  return true;
		}
    </script>
    <title>PPL 2020</title>
</head>
        <div class="container mt-4">
            <h3 class="mb-3" style="font-weight:bold">FORM INPUT MAHASISWA BARU</h3>
            <div class="card mx-auto mb-3" style="width: 30rem;">
                <form method="post" action="" enctype="multipart/form-data" style="padding-left: 4vw; padding-right: 4vw; padding-top: 8px;">
                    <div class="form-group">
                        <label for="nim">Nim</label>
                        <input type="text" class="form-control" id="nim" name="nim" maxLength="9" onKeyPress="return hanyaAngka(event)" required/>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" maxLength="40" required />
                    </div>
                    <div class="form-group">
                        <label>Umur</label>
                        <input type="text" class="form-control" id="umur" name="umur" maxLength="2" onKeyPress="return hanyaAngka(event)" required/>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" class="form-control" accept="image/*" name="gambar" required/>
                    </div>
                    <button class="btn btn-primary btn-block mb-4 mt-4" type="submit" name="submit">Submit</button>
                </form>
            </div>
        </div>
