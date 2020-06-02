<?php
    include '../connectDb.php';
    $conn = connDb();

    $getKodePos = "SELECT * FROM ongkir";
    $listKodePos = $conn->query($getKodePos);

    $dataCustomer = [];
    if(isset($_POST["submit"])){
        $dataCustomer = [
            'username'      =>      $_POST["username"],
            'passwords'     =>      $_POST["password"],
            'nama'          =>      $_POST["nama"],
            'nomor_hp'      =>      $_POST["nomorhp"],
            'alamat'        =>      $_POST["alamat"],
            'kodepos'       =>      $_POST["kodepos"]
        ];
        $query = "INSERT INTO customer (username, password, nama, nomor_hp, alamat, kodepos) VALUES ('".$dataCustomer['username']."','".$dataCustomer['passwords']."', '".$dataCustomer['nama']."', '".$dataCustomer['nomor_hp']."', '".$dataCustomer['alamat']."', '".$dataCustomer['kodepos']."')";
        $result = $conn->query($query);
        if($result){
            header('location:template.php?content=login.php');
            exit();
        }
    }
?>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <title>PPL 2020</title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/new-icon-ico.ico" />
    <style>
        .box{
            justify-content: center;
            margin-top: 5vh;
            margin-bottom: 5vh;
            margin-left: auto;
            margin-right: auto;
            width: 50vh;
            height: fit-content;
            border: 2px solid #000000;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 30px;
            background-color: white;
        }
        .form-style{
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding
        }
    </style>
</head>
    <body style="background-color:#c2c2c2">
        <div class="container">
            <div class="box">
                <h4 class="font-bold mb-4">Form Registrasi</h4>
                <form method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" minlength="6" maxlength="100" placeholder="Min. 6 karakter" required />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" minlength="8" maxlemgth="50" placeholder="Min. 8 karakter" required />
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" minlength="6" maxlength="100" placeholder="Min. 6 karakter" required />
                    </div>
                    <div class="form-group">
                        <label>Nomor Hp</label>
                        <input type="text" name="nomorhp" class="form-control" minlength="11" maxlength="13" placeholder="Min. 11 karakter" required />
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Kode Pos</label>
                        <select class="form-control" name="kodepos">
                            <?php while($list = $listKodePos->fetch_assoc()) { ?>
                                <option value="<?php echo $list['kode_tujuan'] ?>" key="<?php echo $list['kode_tujuan'] ?>"><?php echo $list['kode_tujuan'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success btn-block p-2 mt-4">Submit</button>
                </form>
                <div class="mt-5 text-center">
                    <h6>Sudah punya akun?<span style="margin-left: 3px"><a href="login.php">Masuk</a></span></h6>
                </div>
            </div>
        </div>
    </body>