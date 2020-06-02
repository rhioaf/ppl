<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['cart'])){
        header('location:template.php?content=shoppingcart.php&message=Beli barang terlebih dahulu');
        exit();
    }
    if(!isset($_SESSION['id']) && !isset($_SESSION['username'])){
        header('location:login.php');
        exit();
    }
    include '../connectDb.php';
    $conn = connDb();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    date_default_timezone_set("Asia/Jakarta");
    $resultBerat;
    $totalHarga;
    if(isset($_GET["total"])){
        $totalHarga = $_GET["total"];
    }
    $totalHargaBarang = $totalHarga;
    $date = date("d-m-Y H:i:s");
    $ongkirCost = 0; 

    $insertPenjualan = "INSERT INTO penjualan (id_customer, harga_total) 
    VALUES ('".$_SESSION['id']."', '".$totalHarga."')";
    $statusPenjualan = $conn->query($insertPenjualan);
    
    if($statusPenjualan){
        if(isset($_SESSION['cart'])){
            $tempTotal = 0;
            $currentJumlah = 0;
            $resultBerat = 0;
            foreach($_SESSION['cart'] as $index => $item){
                $query = "INSERT INTO jual VALUES ('".."', '".$item['kodebrg']."', '".$item['harga']."', '".$item['jumlah']."')";
                $statusJual = $conn->query($query);
                if(!is_null($statusJual)){
                    $getStokBarang = "SELECT stok FROM barang WHERE kodebrg=".$item['kodebrg'];
                    $stokBarang = $conn->query($getStokBarang);
                    while($dataBarang = $stokBarang->fetch_array()){
                        $currentJumlah = intval($dataBarang['stok']);
                    }
                    if($item['jumlah'] > 1){
                        $resultBerat += $item['berat'] * $item['jumlah'];
                    } else {
                        $resultBerat += $item['berat'];
                    }
                    $newStok = $currentJumlah - $item['jumlah']; 
                    $queryUpdateStok = "UPDATE barang SET stok='".$newStok."' WHERE kodebrg='".$item['kodebrg']."'";
                    $resultUpdateStok = $conn->query($queryUpdateStok);
                }
            }
            if(is_decimal($resultBerat)){
                $extractBerat = explode('.', (string) $resultBerat);
                if(intval($extractBerat[1]) > 3){
                    $resultBerat = ceil($resultBerat);
                } else {
                    $resultBerat = floor($resultBerat);
                }
            }
            $getOngkirCost = "SELECT total_ongkir FROM ongkir WHERE kode_tujuan=".$dataCustomer['kodepos'];
            $resultOngkir = $conn->query($getOngkirCost);
            if(!is_null($resultOngkir)){
                $tempOngkir = 0;
                while($dataOngkir = $resultOngkir->fetch_array()){
                    $tempOngkir = intval($dataOngkir["total_ongkir"]);
                }
                $ongkirCost = $tempOngkir * $resultBerat;
            }
            $dataCustomer['harga_total'] += $ongkirCost;
            $updateOrder = "UPDATE penjualan SET harga_total='".$dataCustomer['harga_total']."' WHERE id=".$dataCustomer['id'];
            $resultUpdateTotalHarga = $conn->query($updateOrder);
        }
    }

    function formatPrice($param){
        $returnedValue = "Rp. " . number_format($param,0,',','.');
        return $returnedValue;
    }

    function is_decimal( $val ) {
        return is_numeric( $val ) && floor( $val ) != $val;
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
            .box-receipt{
                    margin-left: auto;
                    margin-right: auto;
                    width: 180vh;
                    margin-bottom: 5vh;
                    height: fit-content;
                    border: 2px solid #000000;
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                    padding: 10px;
                }
                .second-box{
                    margin-left: auto;
                    margin-right: auto;
                    width: 120vh;
                    margin-bottom: 3vh;
                    height: fit-content;
                    border: 2px solid #000000;
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                    padding: 4px;
                }
                .add-bg{
                    background-color: white;
                }
                .hr-style{
                    background-color: black;
                    padding-left : 2px;
                    padding-right: 2px;
                    margin-top: 1px;
                    margin-bottom : 2vh;
                }
                .long-button{
                    width: 20vh;
                    padding: 5px;
                }
        </style>
</head>
    <div class="container-fluid">
        <div class="box-receipt mt-3">
            <h3 class="text-center mt-2" style="font-weight:bold;">Receipt</h3>
            <hr style="background-color: black; width: 25vh; margin-top: 0; margin-bottom: 3vh;" />
            <div class="row justify-content-center">
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <h5 class="p-2">Nama</h5>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <h5 class="p-1"><?php echo $dataCustomer['nama'] ?></h5>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <h5 class="p-2">Nomor HP</h5>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <h5 class="p-1"><?php echo $dataCustomer['nomor_hp'] ?></h5>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <h5 class="p-2">Alamat</h5>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <h5 class="p-1"><?php echo $dataCustomer['alamat'] ?></h5>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <h5 class="p-2">Kode Pos</h5>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <h5 class="p-1"><?php echo $dataCustomer['kodepos'] ?></h5>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <h5 class="p-2">Waktu Transaksi</h5>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <h5 class="p-1"><?php echo $date ?></h5>
                </div>
            </div>
            <div class="mt-4">
                <div class="second-box">
                    <h4 class="pb-3 text-center" style="font-weight:bold;">Rincian Pembelian</h4>
                    <div class="row text-center">
                        <div class="col-md-3">
                            <h5>Nama Barang</h5>
                            <hr style="background-color: black; width: 17vh; margin-top: 0; margin-bottom: 2vh" />
                        </div>
                        <div class="col-md-2">  
                            <h5>Harga Barang</h5>
                            <hr style="background-color: black; width: 17vh; margin-top: 0; margin-bottom: 2vh" />
                        </div>
                        <div class="col-md-2">
                            <h5>Jumlah</h5>
                            <hr style="background-color: black; width: 10vh; margin-top: 0; margin-bottom: 2vh" />
                        </div>
                        <div class="col-md-3">
                            <h5>Subtotal Harga</h5>
                            <hr style="background-color: black; width: 17vh; margin-top: 0; margin-bottom: 2vh" />
                        </div>
                        <div class="col-md-2">
                            <h5>Subtotal Berat</h5>
                            <hr style="background-color: black; width: 10vh; margin-top: 0; margin-bottom: 2vh" />
                        </div>
                    </div>
                    <?php
                    $formattedSubTotal = '';
                    $formattedHarga = '';
                    if(isset($_SESSION['cart'])){
                        foreach($_SESSION['cart'] as $index => $item) {
                            $formattedHarga = formatPrice($item['harga']);
                            $formattedSubTotal = formatPrice($item['subtotal']);
                    ?>
                    <div class="row text-center">
                        <div class="col-md-3">
                            <h5><?php echo $item['namabrg'] ?></h5>
                        </div>
                        <div class="col-md-2">
                            <h5><?php echo $formattedHarga ?></h5>
                        </div>
                        <div class="col-md-2">
                            <h5><?php echo $item['jumlah'] ?></h5>
                        </div>
                        <div class="col-md-3">
                            <h5><?php echo $formattedSubTotal ?></h5>
                        </div>
                        <div class="col-md-2">
                            <h5><?php echo $item['jumlah'] * $item['berat'] ?> kg</h5>
                        </div>
                    </div>    
                    <?php  
                        }
                    } 
                        $formattedOngkir = formatPrice($ongkirCost);
                        $formattedTotalHargaBarang = formatPrice($totalHargaBarang);
                        $formattedTotalBayar = formatPrice($dataCustomer['harga_total']);
                    ?>
                    <hr class="hr-style" />
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-3"><h5>Total Berat</h5></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <h5><?php echo $resultBerat ?> kg</h5>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-3"><h5>Total Harga Barang</h5></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <h5><?php echo $formattedTotalHargaBarang ?></h5>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-3"><h5>Total Ongkos Kirim</h5></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <h5><?php echo $formattedOngkir ?></h5>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                        </div>
                        <div class="col-md-3"><h5>Total Pembayaran</h5></div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <h5><?php echo $formattedTotalBayar ?></h5>
                        </div>
                    </div>
                </div>
                <h4 class="text-center mt-5 alert alert-success w-50 mx-auto pb-3" style="font-weight: bold">Pembelian Berhasil!</h4>
                <div class="row justify-content-center">
                    <a href="unset_ops.php?msg=Terima kasih telah melakukan pembelian!" class="btn btn-success long-button">Selesai Belanja</a>
                </div>
            </div>
        </div>
    </div>