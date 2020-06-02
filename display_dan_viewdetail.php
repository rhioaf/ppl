<!DOCTYPE html>
<?php 
    include 'connectDb.php'; 
    $conn = connDb();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $getAllMahasiswa = "SELECT * FROM mahasiswa order by nim desc ";
    $result = $conn->query($getAllMahasiswa);
?>
        <style>
            .th-table-data{
                text-align: center;
                text-transform: uppercase;
                padding-left: 3px;
                padding-right: 3px;
                border-color: #ffffff;
                color: #ffffff;
                background-color: #000000;
            }
            .td-table-data{
                padding: 1vh;
            }
            .style-foto{
                width: 6vw;
                height: 8vw;
            }
            .add-new{
                margin-left:auto;
                padding: 3px;
                margin-bottom: 5px;
            }
            .bold{
                font-weight: bold;
            }
        </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <div class="container mt-3 mb-5">
            <h4 style="font-weight: bold;">Data Mahasiswa</h4>
            <div class="add-new">
                <a href="template.php?content=<?php echo 'inputData.php' ?>">
                    <button class="btn btn-primary"><span class="bold">+</span> Add New</button>
                </a>
            </div>
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
        </div>