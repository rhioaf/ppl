<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php 
    include '../connectDb.php';
    $conn = connDb();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $msg;
    if(isset($_GET['message'])){
        $msg = $_GET['message'];
    }   
    function formatPrice($param){
        $returnedValue = "Rp. " . number_format($param,0,',','.');
        return $returnedValue;
    }
?>

    <head>
        <style>
            .table-center{
                margin-left : auto;
                margin-right: auto;
                margin-bottom : 5vh;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
            .td-padding{
                padding-left : 2vh;
                padding-right : 2vh;
                padding-top : 5px;
                padding-bottom : 5px;
                text-align : center;
            }
            h4{
                text-align: center;
            }
            .margin{
                margin-top: 3vh;
                margin-left: 2vh;
                font-weight: bold;
            }
            .tr-barang{
                text-align : center;
                background-color: #000000;
                color: #ffffff;
                border-color: #ffffff;
            }
            .gambar{
                width: 18rem;
                height: 24vh;
                border-bottom: 2px solid black;
            }
            .box{
                justify-content: center;
                margin-left: auto;
                margin-right: auto;
                width: 40vh;
                margin-bottom: 1vh;
                height: fit-content;
                border: 2px solid #000000;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                padding: 10px;
            }
            .add-bg{
                background-color: white;
            }
            .hr-style{
                background-color: black;
                width: 30vh;
                margin-top: 0;
                margin-bottom: 4vh;
            }
            .img-hover-zoom img {
                transition: transform .5s ease;
            }
                /* [3] Finally, transforming the image when container gets hovered */
            .img-hover-zoom:hover img {
                transform: scale(1.2);
            }
            .card{
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
        </style>
    </head>
            <div class="container">
                <div class="row justify-content-start">
                    <h2 class="margin">Produk Elektronik</h2>
                </div>
                <!-- <hr class="hr-style" /> -->
                <?php if(isset($msg)){ ?>
                    <div class="container">
                        <h5 class="alert alert-danger mx-auto mt-3 w-50"><?php echo $msg ?></h5>
                    </div>
                <?php } ?>
            </div>
                <div class="container">
                    <div class="row justify-content-center pt-4">
                            <?php
                                $result;
                                if(isset($_GET['cari'])){
                                    $valueCari = $_GET['cari'];
                                    $data = "SELECT * FROM barang where namabrg like '%".$valueCari."%' ";
                                    $result = $conn->query($data);
                                } else {
                                    $data = "SELECT * FROM barang";
                                    $result = $conn->query($data);
                                }
                                $formattedHarga;
                                while($results = $result->fetch_assoc()){
                                    $formattedHarga = formatPrice($results["harga"]);
                                    if($results["stok"] > 0) {
                            ?>
                            <div class="col-md-4 mb-5" key=<?php echo $results["kodebrg"] ?>>
                                <div class="card" style="width: 19rem; height: 26rem;">
                                    <div class="card-img-top img-hover-zoom">
                                        <img class="gambar" src=<?php echo '../barang/'.$results["gambar"] ?> alt="Gambar Barang" />
                                    </div>
                                    <div class="card-body">
                                        <div style="height: 8vh;">
                                            <h6 class="card-text" style="font-size: 19px"><?php echo $results["namabrg"]; ?></h6>
                                        </div>
                                        <h5 class="card-text mt-2" style="font-weight: bold;"><?php echo $formattedHarga ?></h5>
                                        <a href="template.php?content=setAmount.php&kode=<?php echo $results["kodebrg"] ?>&nama=<?php echo str_replace(" ", "%20", $results["namabrg"]) ?>" class="btn btn-block btn-secondary mt-2" style="font-weight: bold">Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        <?php }
                            } ?>
                        </div>
                    </div>