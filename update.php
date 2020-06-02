<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>PPL 2020</title>
        <?php
            include 'connectDb.php';
            $conn = connDB();
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
            $status = "";
            $nim = "";
            $namaFile = "";
            if(isset($_GET["nim"])){
                $nim  = $_GET["nim"];
                $getMahasiswa = "SELECT * FROM mahasiswa WHERE nim='$nim'";
                $result2 = $conn->query($getMahasiswa);
                if(!$result2){
                    $status = "Data gagal di dapatkan dari database";
                }
                $getFile = "SELECT namafilefoto FROM mahasiswa WHERE nim='$nim'";
                $resultFile = $conn->query($getFile);
                while($dataFile = $resultFile->fetch_array()){
                    $namaFile = $dataFile["namafilefoto"];
                }
            }
            if(isset($_POST["submit"])){
                $nimBaru = $_POST["nim"];
                $nama = $_POST["nama"];
                $umur = $_POST["umur"];
                $namaGambar = $_FILES["gambar"]["name"];
                $sizeGambar = $_FILES["gambar"]["size"];
                $fileGambar = $_FILES["gambar"]["tmp_name"];
                if($sizeGambar < 1044070){
                    move_uploaded_file($fileGambar, 'fotomahasiswa/'.$namaGambar);
                    $queryUpdate = "UPDATE mahasiswa SET nim='$nimBaru', nama='$nama', umur='$umur', namafilefoto='$namaGambar' WHERE nim='$nim'";
                    $result = $conn->query($queryUpdate);
                    if($result){
                        $locationFile = "fotomahasiswa/".$namaFile;
                        unlink($locationFile);
                        header("location:template.php?content=display_dan_viewdetail.php");
                    }
                }
            }
        ?>
    </head>
    <body>
        <div class="container">
            <?php ?>
            <h3 class="mb-1 mt-3" style="font-weight:bold">FORM UPDATE MAHASISWA BARU</h3>
            <?php 
                while($results = $result2->fetch_assoc()){ ?>
            <form align="center" method="post" action="" enctype="multipart/form-data" style="border: 1px solid black; padding: 5px; margin-bottom:5px">
                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" minLength="1" maxLength="9" onKeyPress="return hanyaAngka(event)" value="<?php echo $results["nim"]; ?>" required />
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" minLength="1" maxLength="40" value="<?php echo $results["nama"]; ?>" required />
                </div>
                <div class="form-group">
                    <label>Umur</label>
                    <input type="text" class="form-control" id="umur" name="umur" minLength="1" maxLength="2" value="<?php echo $results["umur"]; ?>" onKeyPress="return hanyaAngka(event)" required/>
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" class="form-control" accept="image/*" name="gambar" required/>
                </div>
                <br />
                <button class="btn btn-primary btn-lg mt-3 mb-3" type="submit" name="submit">Submit</button>
            </form>
                <?php } ?>
        </div>
    </body>
</html>