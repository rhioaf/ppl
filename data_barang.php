<!DOCTYPE html>
<?php 
    include 'connectDb.php'; 
    $conn = connDb();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $allBarang = "SELECT * FROM barang";
    // session_start();
    // echo $_SESSION["username"];
    // echo $_SESSION["name"];
    $result = $conn->query($allBarang);
?>
        <style>
            .th-table-data{
                text-align: center;
            }
            .td-table-data{
                padding-left : 2vw;
                padding-right : 2vw;
                padding-top : 2px;
                padding-bottom : 2px;
            }
            .style-foto{
                width: 9vw;
                height: 12vw;
            }
        </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            <table border="5" style="margin-left:auto; margin-right:auto;">
                <tr>
                    <th class="th-table-data">Nim</th>
                    <th class="th-table-data">Nama</th>
                    <th class="th-table-data">Umur</th>
                    <th class="th-table-data">Profil</th>
                    <th class="th-table-data">Aksi</th>
                    <th class="th-table-data">Hapus</th>
                    <th class="th-table-data">Update</th>
                </tr>
                <?php 
                while($results = $result->fetch_assoc()){ ?>
                <tr>
                    <td class="td-table-data" name="nim"><?php echo $results["nim"] ?></td>
                    <td class="td-table-data" name="nama"><?php echo $results["nama"]; ?></td>
                    <td class="td-table-data" name="umur"><?php echo $results["umur"]; ?></td>
                    <td class="td-table-data" name="foto"><img src="fotomahasiswa/<?php echo $results["namafilefoto"]; ?>" alt="Profil" class="style-foto" >  </td>
                    <td class="td-table-data"><a href=<?php echo '/webpro/template.php?content=viewdetail.php&nim='.$results["nim"].'&nama='.str_replace(" ", "%20", $results["nama"]).'&umur='.$results["umur"]. '&profil=' .$results["namafilefoto"] ?>>View Detail</a> 
                    </td>
                    <td class="td-table-data"><a href='hapus.php?nim=<?php echo $results["nim"]?>'>Hapus</a></td>
                    <td class="td-table-data"><a href=" <?php echo '/webpro/template.php?content=update.php&nim='.$results["nim"] ?>">Update</a></td>
                </tr>
            <?php } ?>
            </table>
