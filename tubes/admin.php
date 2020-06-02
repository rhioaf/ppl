<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php
    include '../connectDb.php';
    $conn = connDb();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "SELECT * FROM penjualan ORDER BY tanggal DESC";
    $result = $conn->query($query);

    function formatPrice($param){
        $returnedValue = "Rp. " . number_format($param,0,',','.');
        return $returnedValue;
    }
?>
<head>
    <style>
    * {
		font-family: 'Varela Round', sans-serif;
	}
    .header{
		border: 3px solid black;
		width: 100%;
		margin: auto;
		height: 150px;
		background-color: #545252;
	}
    .header-style{
		text-align: center;
		margin-top: 50px;
		font-weight: bold;
		color: white;
	}
    .max-size-logo{
		position: absolute;
		width: 14vh;
		height: 13vh;
		left: 4vh;
		top: 9px;
		z-index: 0;
	}
    .content{
		border-left: 3px solid black;
		border-right: 3px solid black;
		padding: 1vh;
		text-align: center;
		background-color: #c2c2c2;
	}
    .add-bg{
        background-color: white;
    }
    .table-center{
        margin-left : auto;
        margin-right: auto;
        margin-bottom : 5vh;
        margin-top: 2vh;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .tr-barang{
        text-align : center;
        background-color: #000000;
        color: #ffffff;
        border-color: #ffffff;
    }
    .td-padding{
        padding-left : 2vh;
        padding-right : 2vh;
        padding-top : 5px;
        padding-bottom : 5px;
        text-align : center;
        border: 1px solid black;
    }
    .td-padding-2{
        padding-left : 2vh;
        padding-right : 2vh;
        padding-top : 2px;
        text-align : center;
        border: 1px solid black;
    }
    .footer{	
		border: 3px solid black;
		width: 100%;
		margin-bottom: 0;
		height: fit-content;
		padding: 5vh;
		background-color: #545252;
	}
    .footer-style{
		text-align: center;
		font-weight: bold;
		color: white;
	}
    .litle-box{
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);   
        width: 30vh;
        height: 15vh;
        margin: auto;
        padding: 3px;
    }
    .margin{
        padding: 2vh;
        margin: auto;
        font-weight: bold;
        color: white;
    }
    </style>
</head>
    <div class="container-fluid">
            <div class="row justify-content-center" style="background-color:#545252; margin-left: 8px; margin-right: 8px; margin-bottom: 3vh">
                <h4 class="margin">Data Penjualan</h4>
            </div>
            <table class="table-center add-bg">
                <tr>
                    <th class="tr-barang">Kode</th>
                    <th class="tr-barang">Nama</th>
                    <th class="tr-barang">Nomor Hp</th>
                    <th class="tr-barang">Alamat</th>
                    <th class="tr-barang">Kodepos</th>
                    <th class="tr-barang">Harga Total</th>
                    <th class="tr-barang">Tanggal Pembelian</th>
                    <th class="tr-barang">Status</th>
                    <th class="tr-barang" colspan="2">Aksi</th>
                </tr>
                <?php 
                    $statusMessage; 
                    $formattedTotalHarga;
                    while($results = $result->fetch_assoc()) {
                    switch($results["status"]){
                        case 0 : $statusMessage = 'Belum Bayar';
                                 break;
                        case 1 : $statusMessage = 'Sudah Dibayar';
                                 break;
                        case 2 : $statusMessage = 'Sudah Dikirim';
                                 break;
                        default : $statusMessage = 'Tidak jelas';
                    }
                    $formattedTotalHarga = formatPrice($results["harga_total"]); 
                    ?>    
                    <tr style="border: 1px solid black">
                        <td class="td-padding"><?php echo $results["id"] ?></td>
                        <td class="td-padding"><?php echo $results["nama"] ?></td>
                        <td class="td-padding"><?php echo $results["nomor_hp"] ?></td>
                        <td class="td-padding" style="width:32vh;"><?php echo $results["alamat"] ?></td>
                        <td class="td-padding"><?php echo $results["kodepos"] ?></td>
                        <td class="td-padding"><?php echo $formattedTotalHarga ?></td>
                        <td class="td-padding"><?php echo $results["tanggal"] ?></td>
                        <?php switch($results["status"]) { 
                            case 0 : 
                        ?>
                            <td class="td-padding"><div class="alert alert-danger mt-2" role="alert"><?php echo $statusMessage ?></div></td>
                            <td class="td-padding"><a href="updateStatus.php?kode=<?php echo $results["id"] ?>&key=0" class="btn btn-primary">Update Status</a></td>
                            <?php break; 
                            case 1 :     
                        ?>
                            <td class="td-padding"><div class="alert alert-warning mt-2" role="alert"><?php echo $statusMessage ?></div></td>
                            <td class="td-padding"><a href="updateStatus.php?kode=<?php echo $results["id"] ?>&key=1" class="btn btn-primary">Update Status</a></td>
                            <?php break;
                            case 2 : 
                        ?>
                            <td class="td-padding"><div class="alert alert-success mt-2" role="alert"><?php echo $statusMessage ?></div></td>
                            <td class="td-padding-2"></td>
                        <?php 
                            break;
                            } ?>
                        <td class="td-padding"><a class="btn btn-primary" href="templateAdmin.php?content=detailPenjualan.php&id=<?php echo $results["id"] ?>">Detail Penjualan</a></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        
