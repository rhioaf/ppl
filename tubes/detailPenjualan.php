<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php
    include './Jual.php';
    include './Barang.php';
    include '../connectDb.php';
    $conn = connDb();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $id = $_GET['id'];
    $query = "SELECT * FROM penjualan WHERE id=".$id;
    $result = $conn->query($query);
    $dataPenjualan = [];
    $statusMessage = '';
    while($results = $result->fetch_assoc()){
        switch($results["status"]){
            case 0 : $statusMessage = "Belum bayar";
                     break;
            case 1 : $statusMessage = "Sudah bayar";
                     break;
            case 2 : $statusMessage = "Sudah dikirim";
                     break;
            default : $statusMessage = "Tidak jelas";
        }
        $dataPenjualan = [
            'id'            =>      $results["id"],
            'nama'          =>      $results["nama"],
            'nomor_hp'      =>      $results["nomor_hp"],
            'alamat'        =>      $results["alamat"],
            'kodepos'       =>      $results["kodepos"],
            'harga_total'   =>      $results["harga_total"],
            'tanggal'       =>      $results["tanggal"],
            'status'        =>      $statusMessage  
        ];
    }

    $dataPembelian = array();
    $getPembelian = "SELECT * FROM jual WHERE id_penjualan=".$id;
    $resultPembelian = $conn->query($getPembelian);
    $objJual;
    $indexJual = 1;
    while($results = $resultPembelian->fetch_assoc()){
        $objJual = new Jual(intval($results["id_penjualan"]), intval($results["kodebrg"]), floatval($results["harga"]), intval( $results["jumlah"]));
        $dataPembelian[$indexJual] = $objJual;
        $indexJual++;
    }

    $dataBarang = array();
    $getBarang = "SELECT * FROM barang";
    $resultBarang = $conn->query($getBarang);
    $objBarang;
    $indexBarang = 1;
    while($results = $resultBarang->fetch_assoc()){
        $objBarang = new Barang(intval($results["kodebrg"]), $results["namabrg"], floatval($results["harga"]), intval($results["stok"]), doubleval($results["berat"]), $results["gambar"]);
        $dataBarang[$indexBarang] = $objBarang;
        $indexBarang++;
    }
    
    function formatPrice($param){
        $returnedValue = "Rp. " . number_format($param,0,',','.');
        return $returnedValue;
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
        width: 190vh;
        height: fit-content;
        border: 2px solid #000000;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 30px;
    }
    .margin{
        padding: 2vh;
        margin: auto;
        font-weight: bold;
        color: white;
    }
    .information-box{
        justify-content: center;
        margin-top: 5vh;
        margin-bottom: 5vh;
        margin-left: auto;
        margin-right: auto;
        width: 90vh;
        height: fit-content;
        border: 2px solid #000000;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 10px;
    }
    .penjualan-box{
        justify-content: center;
        margin-top: 5vh;
        margin-bottom: 5vh;
        margin-left: auto;
        margin-right: auto;
        width: 160vh;
        height: fit-content;
        border: 2px solid #000000;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        padding: 10px;
    }
    .pos-image{
        width: 15rem;
        height: 20vh;
        position: absolute;
        left: 10px;
        top: 60px;
    }
    </style>
</head>
<div class="container-fluid">
        <div class="penjualan-box">
            <h4 class="pb-3">Data Transaksi</h4>
            <div class="row">
                <?php
                    $getIndexBarang = 0;
                    $indexJualArray = 1;
                    $indexDataBarang = 1;
                    $hargaBeli;
                    $hargaBarang;
                    while($indexJualArray <= count($dataPembelian)){
                        while($indexDataBarang <= count($dataBarang)){
                            if($dataPembelian[$indexJualArray]->getKode() == $dataBarang[$indexDataBarang]->getKode()){
                                $getIndexBarang = $indexDataBarang;
                                break;
                            }
                            $indexDataBarang++;
                        }
                        $hargaBeli = formatPrice($dataPembelian[$indexJualArray]->getHarga());
                        $hargaBarang = formatPrice($dataBarang[$getIndexBarang]->getHarga());
                ?>
                <div class="col-md-12 pb-4">
                    <div class="card mx-auto" style="width: 140vh; height: 100%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                        <div class="card-header"><h5>Transaksi - <?php echo $indexJualArray ?></h5></div>
                        <div class="card-body">
                            <div class="img-hover-zoom">
                                <img class="pos-image" src=<?php echo '../barang/'.$dataBarang[$getIndexBarang]->getGambar() ?> alt="Gambar" />
                            </div>
                            <div class="row ml-5">
                                <div class="col-md-2"></div>
                                <div class="col-md-3"><h5>Nama Barang</h5></div>
                                <div class="col-md-3"><h5>Harga Beli</h5></div>
                                <div class="col-md-3"><h5>Jumlah Beli</h5></div>
                            </div>
                            <div class="row pt-2 ml-5">
                                <div class="col-md-2"></div>
                                <div class="col-md-3"><h5><?php echo $dataBarang[$getIndexBarang]->getNama() ?></h5></div>
                                <div class="col-md-3"><h5><?php echo $hargaBeli ?></h5></div>
                                <div class="col-md-3"><h5><?php echo $dataPembelian[$indexJualArray]->getJml() ?> item</h5></div>
                            </div>
                            <hr style="background-color: black; margin-left: 27vh" />
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 style="margin-left: 2vw">Detail Barang</h5>
                                    <div class="row ml-2 pt-2">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2"><h5>Kode</h5></div>
                                        <div class="col-md-2"><h5>Stok</h5></div>
                                        <div class="col-md-2"><h5>Harga</h5></div>
                                        <div class="col-md-2"><h5>Berat</h5></div>
                                    </div>
                                    <div class="row ml-2 pt-2">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2"><h5><?php echo $dataBarang[$getIndexBarang]->getKode() ?></h5></div>
                                        <div class="col-md-2"><h5><?php echo $dataBarang[$getIndexBarang]->getStok() ?></h5></div>
                                        <div class="col-md-2"><h5><?php echo $hargaBarang ?></h5></div>
                                        <div class="col-md-2"><h5><?php echo $dataBarang[$getIndexBarang]->getBerat() ?> kg</h5></div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
                <?php
                    $indexJualArray++;
                    } 
                ?>
            </div>
        </div>
        <div class="row pt-2">
            <div class="col-md-9"></div>
            <div class="col-md-3">
                <a href="templateAdmin.php?content=admin.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>