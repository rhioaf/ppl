<!-- Nama : Rhio Adjie Fabian
     NIM : 181511064
     Kelas : 2b -->
<!DOCTYPE html>
<html>
    <head>
        <title>PPL 2020</title>
        <style>
            .center{
                margin-left: auto;
                margin-right: auto;
                margin-top: 5vh;
            }
            .error{
                color: #FF0000;
            }
        </style>
        <script>
            function hanyaAngka(evt) {
		        var charCode = (evt.which) ? evt.which : event.keyCode
		        if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
		        return true;
		    }
        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <?php 
            include 'connectDb.php';
            $conn = connDB();
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $errNim = $errNama = $errNoTelp = $errEmail = $errGender = "";
            $nim = $nama = $notelp = $email = $gender = $resultMsg = "";
            if(isset($_POST['form'])){
                if(empty($_POST["nim"])){
                    $errNim = "Nim tidak boleh kosong";
                } else{
                    $nim = test_input($_POST["nim"]);
                    if(!preg_match("/^[0-9]*$/", $nim)){
                        $errNim = "NIM hanya boleh angka";
                    } else if(strlen($nim) < 9 || strlen($nim) > 9 ){
                        $errNim = "NIM tidak valid (Minimal dam Maksimal value 9)";
                    } else {
                        $errNim = "";
                    }
                }
                if(empty($_POST["nama"])){
                    $errNama = "Nama tidak boleh kosong";
                } else{
                    $nama = test_input($_POST["nama"]);
                    if(!preg_match("/^[a-zA-Z ]*$/", $nama)){
                        $errNama = "Nama tidak valid";
                    } else if(preg_match("/^[0-9]*$/", $nama)){
                        $errNama = "Nama tidak boleh hanya angka";
                    } else{
                        $errNama = "";
                    }
                }
                if(empty($_POST["notelp"])){
                    $errNoTelp = "Nomor telepon tidak boleh kosong";
                } else{
                    $notelp = test_input($_POST["notelp"]);
                    if(!preg_match("/^[0-9]*$/", $notelp)){
                        $errNoTelp = "No Telepon hanya boleh angka";
                    } else if(strlen($notelp) < 11 || strlen($notelp) > 13) {
                        $errNoTelp = "No Telepon tidak valid (Minimal value 11 dan Maksimal value 13)";
                    } else{
                        $errNoTelp = "";
                    }
                }
                if(empty($_POST["email"])){
                    $errEmail = "Email tidak boleh kosong";
                } else{
                    $email = test_input($_POST["email"]);
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $errEmail = "Email tidak valid";
                    } else {
                        $errEmail = "";
                    }
                }
                if (empty($_POST["gender"])) {
                    $errGender = "Jenis kelamin tidak boleh kosong";
                  } else {
                    $gender = test_input($_POST["gender"]);
                  }
                if(empty($errNim) && empty($errNama) && empty($errNoTelp) && empty($errEmail) && empty($errGender)){
                    $query = "INSERT INTO mhsw VALUES(' ".$nim."', '".$nama."', '".$notelp."', '".$email."', '".$gender."' )";  
                    $result = $conn->query($query);
                    if($result){
                        $resultMsg = "Berhasil ditambahkan ke database";
                    } else{
                        $resultMsg = "Tidak berhasil ditambahkan ke database";
                    }
                    $conn->close();
                }
            }
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
        <div class="container center">
            <h1>Form Validation</h1>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <form method="post">
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" class="form-control" min="9" max="9" placeholder="NIM anda" id="nim" name="nim" />
                            <?php if(!empty($errNim)) { ?>
                                <span class="error"> Error : <?php echo $errNim;  ?></span>
                            <?php } else { ?>
                                <span class="error"> Error : Tidak ada error </span>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label>NAMA</label>
                            <input type="text" class="form-control" min="5" max="30" placeholder="Nama anda" id="nama" name="nama" />
                            <?php if(!empty($errNama)) { ?>
                                <span class="error"> Error : <?php echo $errNama;  ?></span>
                            <?php } else { ?>
                                <span class="error"> Error : Tidak ada error </span>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="text" class="form-control" min="11" max="13" placeholder="Nomor telepon anda" id="notelp" name="notelp" />
                            <?php if(!empty($errNoTelp)) { ?>
                                <span class="error"> Error : <?php echo $errNoTelp;  ?></span>
                            <?php } else { ?>
                                <span class="error"> Error : Tidak ada error </span>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label>EMAIL</label>
                            <input type="text" class="form-control" min="5" max="50" placeholder="Email anda" id="email" name="email" />
                            <?php if(!empty($errEmail)) { ?>
                                <span class="error"> Error : <?php echo $errEmail;  ?></span>
                            <?php } else { ?>
                                <span class="error"> Error : Tidak ada error </span>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label class="mr-3">GENDER</label>
                            <input type="radio" name="gender" id="gender" <?php if(isset($gender) && $gender=="Pria") echo "checked" ?> value="Pria">Pria</input> &nbsp;
                            <input type="radio" name="gender" id="gender" <?php if(isset($gender) && $gender=="Panita") echo "checked" ?> value="Wanita">Wanita</input>
                            <br/>
                            <?php if(!empty($errGender)) { ?>
                                <span class="error"> Error : <?php echo $errGender;  ?></span>
                            <?php } else { ?>
                                <span class="error"> Error : Tidak ada error </span>
                            <?php } ?>
                        </div>
                        <span> <?php if(!empty($resultMsg)) {echo $resultMsg; } else {echo "";} ?> </span>
                        <br>
                        <button type="submit" name="form" class="btn btn-secondary mt-3">Submit</button>
                    </form>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h3>Hasil Input</h3>
                    <label>NIM</label>
                    <input type="text" class="form-control" value="<?php if(empty($errNim)) {echo $nim;} else {echo "";} ?>"/>
                    <label>NAMA</label>
                    <input type="text" class="form-control" value="<?php if(empty($errNama)) {echo $nama;} else {"";} ?>"/>
                    <label>NO TELEPON</label>
                    <input type="text" class="form-control" value="<?php if(empty($errNoTelp)) {echo $notelp;} else {echo "";} ?>"/>
                    <label>EMAIL</label>
                    <input type="text" class="form-control" value="<?php if(empty($errEmail)) {echo $email;} else {echo "";} ?>"/>
                    <label>GENDER</label>
                    <input type="text" class="form-control" value="<?php if(empty($errGender)) {echo $gender;} else {echo "";} ?>"/>
                </div>
            </div>
            
        </div>
    </body>
</html>