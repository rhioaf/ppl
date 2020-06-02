<!DOCTYPE html>
<?php 
    include 'connectDb.php'; 
    $conn = connDb();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else{
        echo "DB Connected";
    } 
    $getAllMahasiswa = "SELECT * FROM mahasiswa order by nim desc ";
    $result = $conn->query($getAllMahasiswa);
?>
<html>
    <head>
        <title>PPL 2020</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <style>
            th {
               background-color: aqua; 
               padding : 8px;
            }
            td{
                padding: 11px;
            }
            table{
                width: 100vh;
                height: 10vh;
                text-align: center;
                border-color: greenyellow;
                margin-left: auto;
                margin-right: auto;
                margin-top: 10vh;
            }
        </style>
        <body>
            <table border="5">
                <tr>
                    <th>Nim</th>
                    <th>Nama</th>
                    <th>Umur</th>
                </tr>
                <?php 
                while($results = $result->fetch_assoc()){ ?>
                <tr>
                    <td name="nim"><?php echo $results["nim"]; ?></td>
                    <td name="nama"><?php echo $results["nama"]; ?></td>
                    <td name="umur"><?php echo $results["umur"]; ?></td>
                </tr>
            <?php } ?>
            </table>
        </body>
    </head>
</html>