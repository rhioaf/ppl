<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php 
    include '../connectDb.php';
    $conn = connDb();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $total = 0;
    $status;
    $msg;
    $msgSuccess;
    if(isset($_GET['message'])){
        $msg = $_GET['message'];
    }
    if(isset($_GET['success'])){
        $msgSuccess = $_GET['success'];
    }
    $dataPembelian = [];
    if(isset($_GET["kode"]) & isset($_GET["jumlah"])){
        $dataPembelian['kode'] = $_GET["kode"];
        $dataPembelian['jml'] = $_GET["jumlah"];
        $query = "SELECT * FROM barang WHERE kodebrg=".$dataPembelian['kode'];
        $result = $conn->query($query);
        while($results = $result->fetch_assoc()){
            $dataPembelian['nama'] = $results["namabrg"];
            $dataPembelian['harga'] = floatval($results["harga"]);
            $dataPembelian['stok'] = intval($results["stok"]);
            $dataPembelian['berat'] = floatval($results["berat"]);
        }

        if($dataPembelian['stok'] < $dataPembelian['jml']){
            header('location:template.php?content=tabel_barang.php&message=Stok '.$dataPembelian['nama'].' tidak mencukupi');
            exit();
        } else {
            $arrayIndex = null;
            if(isset($_SESSION['cart'])) {
                foreach($_SESSION['cart'] as $indexArray => $objectItem){
                    if(intval($objectItem['kodebrg']) == intval($dataPembelian['kode'])){
                        $arrayIndex = $indexArray;
                        break;
                    }
                }
            }
            if(is_null($arrayIndex)){
                $_SESSION['cart'][] = [
                    'kodebrg'   =>  $dataPembelian['kode'],
                    'namabrg'   =>  $dataPembelian['nama'],
                    'harga'     =>  $dataPembelian['harga'],
                    'jumlah'    =>  $dataPembelian['jml'],
                    'subtotal'  =>  $dataPembelian['harga'] * $dataPembelian['jml'],
                    'berat'     =>  $dataPembelian['berat'],
                    'stok'      =>  $dataPembelian['stok']
                ];
            } else {
                $namaBarang = $_SESSION['cart'][$arrayIndex]['namabrg'];
                if($dataPembelian['jml'] <= $dataPembelian['stok']){
                    $_SESSION['cart'][$arrayIndex]['jumlah'] = $dataPembelian['jml'];
                    $_SESSION['cart'][$arrayIndex]['subtotal'] = $_SESSION['cart'][$arrayIndex]['harga'] * $_SESSION['cart'][$arrayIndex]['jumlah'];
                } else {
                    header('location:template.php?content=tabel_barang.php&message=Stok '.$namaBarang.' tidak mencukupi untuk menambah jumlah pembelian');
                    exit();
                }
            }
        }
    }
    if(!isset($_SESSION['cart'])){
        $status = "Belum ada barang yang dibeli";
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
            .td-table-data{
                padding-right : 2vh;
                padding-left: 2vh;
                padding-top : 3px;
                padding-bottom : 3px;
                text-align: center;
                border-right: 2px solid black;
            }
            .td-table-data-2{
                padding-right : 2vh;
                padding-left: 2vh;
                padding-top : 3px;
                padding-bottom : 3px;
                text-align: center;
            }
            .th-table-data{
                padding-left : 2vh;
                padding-right : 2vh;
                padding-top : 3px;
                padding-bottom : 3px;
                text-align: center;
                color : #ffffff;
                background-color: #000000;
                border-right: 2px solid white;
            }
            .th-table-data-2{
                padding-left : 2vh;
                padding-right : 2vh;
                padding-top : 3px;
                padding-bottom : 3px;
                text-align: center;
                color : #ffffff;
                background-color: #000000;
            }
            .table-style{
                margin-top : 1vw;
                margin-bottom : 4vw;
                margin-left: auto;
                margin-right: auto;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
            .long-button{
                width: 15vh;
                padding: 5px;
            }
            .long-button-2{
                width: 9vh;
            }
            .add-bg{
                background-color: white;
            }
            .margin{
                padding: 2vh;
                margin: auto;
                font-weight: bold;
                color: white;
            }
            .border-style{
                border-bottom: 2px solid black;
            }
        </style>
        </head>
        <div class="container-fluid">
            <div class="row justify-content-center" style="background-color:#545252; padding-left: 5px; padding-right: 5px; margin-bottom: 3vh">
                <h4 class="margin">Cart</h4>
            </div>
            <?php if(isset($status)) { ?>
                <div class="container">
                    <h5 class="alert alert-dark mx-auto mt-1 w-50"><?php echo $status ?></h5>
                </div>
            <?php } 
                if(isset($msg)){ 
            ?>
                <div class="container">
                    <h5 class="alert alert-danger mx-auto mt-1 w-50"><?php echo $msg ?></h5>
                </div>
            <?php } 
                if(isset($msgSuccess)) {
            ?>
                <div class="container">
                    <h5 class="alert alert-success mx-auto mt-1 w-50"><?php echo $msgSuccess ?></h5>
                </div>
            <?php } ?>

            <table class="table-style add-bg">
                <tr>
                    <th class="th-table-data">Kode</th>
                    <th class="th-table-data" style="width: 30vh;">Nama Barang</th>
                    <th class="th-table-data">Harga</th>
                    <th class="th-table-data">Jumlah</th>
                    <th class="th-table-data">Stok</th>
                    <th class="th-table-data">Subtotal Harga</th>
                    <th class="th-table-data-2" colspan="3">Aksi</th>
                </tr>
                <?php 
                    $formattedSubTotal = '';
                    $formattedHarga = '';
                    $formattedTotalHarga = '';
                    if(isset($_SESSION['cart'])){
                        foreach($_SESSION['cart'] as $indexItem => $item) {
                            $formattedHarga = formatPrice($item['harga']);
                            $formattedSubTotal = formatPrice($item['subtotal']);
                            $total += ($item['jumlah'] * $item['harga']);
                            $formattedTotalHarga = formatPrice($total);
                ?>
                <tr class="border-style">  
                    <td class="td-table-data"><?php echo $item['kodebrg'] ?></td>
                    <td class="td-table-data" style="width: 30vh;"><?php echo $item['namabrg'] ?></td>
                    <td class="td-table-data"><?php echo $formattedHarga ?></td>
                    <td class="td-table-data"><?php echo $item['jumlah'] ?></td>
                    <td class="td-table-data"><?php echo $item['stok'] ?></td>
                    <td class="td-table-data"><?php echo $formattedSubTotal ?></td>
                    <td class="td-table-data"><a href="addAmount.php?kode=<?php echo $item['kodebrg'] ?>"><img src="../images/add.png" style="width: 4vh; height: 4vh" /></a></td>
                    <td class="td-table-data"><a href="reduceItem.php?kode=<?php echo $item['kodebrg'] ?>"><img src="../images/minus.png" style="width: 4vh; height: 4vh" /></a></td>
                    <td class="td-table-data-2"><a href="removeItem.php?kode=<?php echo $item['kodebrg'] ?>"><img src="../images/cancel.png" style="width: 4vh; height: 4vh" /></a></td>
                </tr>
            <?php    
                }   
            } ?>
                <tr>
                    <td colspan="6" style="text-align:right; font-weight: bold" class="td-table-data">Total Harga : <?php echo $formattedTotalHarga; ?> </td>
                </tr>
            </table>
            <div class="row justify-content-center mb-5">
                <div class="col-md-4">
                    <a href="/webpro/tubes/template.php?content=tabel_barang.php">
                        <button class="btn btn-secondary long-button">Kembali</button>
                    </a>
                </div>
                <div class="col-md-4">
                   <a href="unset_session_cart.php" class="btn btn-danger long-button">Clear Cart</a>
                </div>
                <?php if(isset($_SESSION['cart'])) { ?>
                <div class="col-md-4">
                    <a href="/webpro/tubes/template.php?content=receipt.php&total=<?php echo $total ?>" class="btn btn-primary long-button">Checkout</a>
                </div>
                <?php } else { ?>
                <div class="col-md-4">
                    <button class="btn btn-primary long-button" onclick="alert('Keranjang masih kosong')">Checkout</button>
                </div>
                <?php } ?>
            </div>