<!DOCTYPE html>
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
                $i = 1;
                while($i <= 10){ ?>
                <tr>
                    <td>181511064</td>
                    <td>Rhio Adjie Fabian</td>
                    <td>19</td>
                </tr>
            <?php $i++; } ?>
            </table>
        </body>
    </head>
</html>