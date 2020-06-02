<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php
    if(!isset($_GET['content'])){
		$vcontent = 'admin.php';
	} else {
		$vcontent = $_GET['content'];
	}
?>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
            integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <title>PPL 2020</title>
        <link rel="shortcut icon" type="image/x-icon" href="../images/new-icon-ico.ico" />
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
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="header">
                <img src="../images/new-icon.png" alt="Logo" class="max-size-logo">
                <h3 class="header-style">Halaman Admin</h3>
            </div>
            <div class="content">
                <?php include $vcontent; ?>
            </div>
            <div class="footer">
                <h5 class="footer-style">All Rights Reserved</h5>
            </div>
        </div>
    </body>
</html>