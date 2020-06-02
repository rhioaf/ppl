<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php 
    include '../connectDb.php';
    $conn = connDb();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $totalHarga;
    $msg;
    if(isset($_GET['total'])){
        $totalHarga = $_GET['total'];
    }
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    if(!isset($_SESSION['cart'])){
        header('location:template.php?content=shoppingcart.php&message=Beli barang terlebih dahulu');
        exit();
    }
     
    $getKodePos = "SELECT * FROM ongkir";
    $listKodePos = $conn->query($getKodePos);

    // Final validation of cart
    $stok;
    $errMsg;
    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $index => $item){
            $getStokBarang = "SELECT stok FROM barang WHERE kodebrg=".$item['kodebrg'];
            $result = $conn->query($getStokBarang);
            while($data = $result->fetch_array()){
                $stok = $data['stok'];
            }
            if($stok < $item['jumlah']){
                $errMsg ="".$item['namabrg']." yang anda pesan melebihi stok yang tersedia";
                header('location:template.php?content=shoppingcart.php&message='.$errMsg);
                exit();
            }
        }
    }
?>
    <head>
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
        <div class="container">
            <div class="box">
                <h4 class="text-center">Silahkan isi data diri anda dan alamat tujuan!</h4>
            <?php if(isset($msg)) { ?>
                <div class="container">
                    <h5 class="alert alert-danger w-100 mt-3 mx-auto"><?php echo $msg ?></h5>
                </div>
            <?php } ?>
                <hr style="background-color: #000000; margin-top:0" />
                <form method="post" action="/webpro/tubes/template.php?content=receipt.php">
                    <?php if(isset($_GET['total'])) { ?>
                    <div class="form-group">
                        <input type="hidden" name="total" id="total" value=<?php echo $totalHarga ?> />
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" maxlength="50" name="nama" required/>
                    </div>
                    <div class="form-group">
                        <label>Nomor Hp</label>
                        <input type="text" class="form-control" maxlength="13" minlength="11" name="nomor" onkeypress="return hanyaAngka(event)" required />
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
                    <button type="submit" name="submitform" id="submitform" class="btn btn-success btn-block p-2 mt-4">Submit</button>
                </form>
            </div>
        </div>