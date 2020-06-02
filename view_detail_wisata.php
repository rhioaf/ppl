<html>
<?php
    include 'connectDb.php';
    $conn = connDb();
    $id = $_GET["id"];
    $nama = $_GET["nama"];
    $ket = $_GET["ket"];
    if(isset($_POST['submit'])){
        $newNama = $_POST["namab"];
        $newKet = $_POST["keteranganb"];
        $updateData = "UPDATE obyekwisata SET nama='$newNama', keterangan='$newKet' WHERE id='$id'";
        $result = $conn->query($updateData);
        if($result){
            header("location:display_obyek_wisata.php");
        }
    }
?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .table-center{
            margin-left : auto;
            margin-right : auto;
        }
        .td-table-data{
                padding-left : 2vw;
                padding-right : 2vw;
                padding-top : 3px;
                padding-bottom : 3px;
            }
         .style-foto{
            width: 10vw;
            height: 14vw;
        }
    </style>
</head>
<body>
        <div class="container">
            <h1>Form Update Obyek Wisata</h1>
            <form action="" method="post">
                <label>NAMA</label>
                <input type="text" name="namab" id="namab" class="form-control" value="<?php echo $nama; ?>" require  />
                <label>KETERANGAN</label>
                <input type="text" name="keteranganb" id="keteranganb" class="form-control" value="<?php echo $ket; ?>" require />
                <button type="submit" name="submit" class="btn btn-primary mt-3">Update</button>
            </form> 
        </div>
</body>
</html>