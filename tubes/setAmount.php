<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    $kode = $_GET['kode'];
    $currentJml = 0;
    $namaBarang = $_GET['nama'];
    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $index => $item){
            if($item['kodebrg'] == $kode){
                $currentJml = $item['jumlah'];
                break;
            }
        }
    }
    if(isset($_POST["submit"])){
        $amount = $_POST["jumlah"];
        header('location:template.php?content=shoppingcart.php&kode='.$kode.'&jumlah='.$amount.'');
        exit();
    }
?>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
    .center{
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
    </style>
    <script>
        function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))   return false;
		  return true;
		}
    </script>
</head>
<div class="container">
    <div class="box">
        <div class="row justify-content-center" style="background-color:#545252; padding-left: 7px; padding-right: 7px; margin-bottom: 2vh">
            <h5 class="py-2 text-white">Masukkan jumlah pembelian</h5>
        </div>
        <h6>Jumlah <?php echo $namaBarang ?> pada cart : <?php echo $currentJml ?></h6>
        <form class="center" method="post">
            <div class="form-group">
                <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="jumlah" required />
            </div>
            <button type="submit" name="submit" class="btn btn-success btn-block">Tambahkan</button>
        </form>
    </div>
</div>