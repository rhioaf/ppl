<?php
    $nim = $_GET["nim"];
    $nama = $_GET["nama"];
    $umur = $_GET["umur"];
    $foto = $_GET["profil"];
?>
    <style>
        .th-table-data{
            text-align: center;
            padding-left: 3px;
            padding-right: 3px;
            border-color: #000000;
        }
        .table-center{
            margin-left : auto;
            margin-right : auto;
            margin-top: 5vh;
            margin-bottom: 5vh;
        }
        .td-table-data{
            padding: 1vh;
        }
         .style-foto{
            width: 10vw;
            height: 12vw;
        }
    </style>
        <table border="1" class="table-center">
            <tr>
                <th class="th-table-data">NIM</th>
                <th class="th-table-data">NAMA</th>
                <th class="th-table-data">UMUR</th>
                <th class="th-table-data">PROFIL</th>
            </tr>
            <tr>
                <td class="td-table-data"><?php echo $nim ?></td>
                <td class="td-table-data"><?php echo $nama ?></td>
                <td class="td-table-data"><?php echo $umur ?></td>
                <td class="td-table-data"> <img src="fotomahasiswa/<?php echo $foto; ?>" alt="Profil" class="style-foto"> </td>
            </tr>
        </table>