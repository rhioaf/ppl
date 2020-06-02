<!DOCTYPE html>
<html>
    <head>
        <?php 
            session_start();
            if(!isset($_SESSION['username'])) { 
                header('location:login_pake_database.php?status="Anda belum login"');
                exit;
            }
            include 'connectDb.php';
            $conn = connDb();

            $getAll = "SELECT * FROM obyekwisata order by id";
            $result = $conn->query($getAll);

        ?>
        <title>PPL UTS</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            .table-data{
                border: 1px solid black;
                border-collapse: collapse;
                width: 100%;
                height: 100px;
                margin: auto;
                text-align: center;
            }
            .tr-header{
                border: 3px solid black;
                border-collapse: collapse;
                width: 100%;
                margin: auto;
                height: 100px;
            }
            .tr-primary{
                border: 3px solid black;
                border-collapse: collapse;
                width: 100%;
                margin: auto;
                text-align: center;
                height: 100px;
            }
            .tr-secondary{
                border: 3px solid black;
                border-collapse: collapse;
                width: 100%;
                margin: auto;
                text-align: center;
                height: 60px;
            }
            .style-text{
                color: black;
            }
            .max-size-logo{
                width: 13vh;
                height: 17vh;
                padding-left: 10px;
                float: left;
            }
            .padding-header{
                padding-top: 2vw;
                padding-right: 7vw;
                text-align: center;
            }
            .img-size{
                width: 20vh;
                height: 20vh
            }
        </style>
    </head>
    <body>
        <div class="container">
            <table class="table-data">
                <tr>
                    <th>
                        <h3 class="padding-header">
                            Obyek Wisata
                        </h3>
                        <br>
                        <a href="logout.php">LOGOUT</a>
                    </th>
                </tr>
                <tr class="tr-primary">
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Keterangan</th>
                    <th>Update</th>
                </tr>
                <?php 
                    while($results = $result->fetch_assoc()){ ?>
                <tr>
                    <td class="td-table-data"><?php echo $results["id"] ?></td>
                    <td class="td-table-data"><?php echo $results["nama"];  ?></td>
                    <td class="td-table-data"><img class="img-size" src="images/<?php echo $results["filegambar"]; ?>"></td>
                    <td class="td-table-data"><?php echo $results["keterangan"]?></td>
                    <td>
                        <a href="view_detail_wisata.php?id=<?php echo $results["id"] ?>&nama=<?php echo $results["nama"]?>&ket=<?php echo $results["keterangan"]?>">Update Obyek Wisata</a>
                    </td>
                </tr>
                    <?php } ?>
            </table>
        </div>
    </body>
</html>