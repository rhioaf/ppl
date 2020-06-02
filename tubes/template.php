<!--    Nama : Rhio Adjie Fabian 
        NIM  : 181511064
        Kelas : 2b -->
<?php
	if(!isset($_GET['content'])){
		$vcontent = 'tabel_barang.php';
	} else {
		$vcontent = $_GET['content'];
	}
	session_start();
	if(!isset($_SESSION['username']) && !isset($_SESSION['id'])){
        header('location:login.php');
        exit();    
	}
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$statusForm = false;
	if($actual_link == "http://localhost/webpro/tubes/template.php"){
		$statusForm = true;
	}
	$status_cart;
	if(isset($_SESSION['cart'])){
		$countItem = 0;
		foreach($_SESSION['cart'] as $index => $item){
			$countItem++;
		}
		$status_cart = 'Terdapat ' . $countItem. " barang di cart";
	} else {
		$status_cart = "Cart masih kosong";
	}
?>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <title>PPL 2020</title>
	<link rel="shortcut icon" type="image/x-icon" href="../images/new-icon-ico.ico" />
	<style>
		*{
			font-family: 'Varela Round', sans-serif;
			scroll-behavior: smooth;
		}
		.btn-secondary{
			background-color: #343a40;
		}
		.style-text{
			color: black;
			font-weight: bold;
			padding: 5px;
			text-align: center;
			width: 13vh;
			height: 4vh;
		}
		.style-text-2{
			color: black;
			font-weight: bold;
			text-align: center;
			padding: 5px;
			width: 6vh;
			height: 4vh;
		}
		.header-style{
			text-align: center;
			margin-top: 50px;
			font-weight: bold;
			color: white;
		}
		.footer-style{
			text-align: center;
			font-weight: bold;
			color: white;
		}
		.tr-secondary>td>a:hover{
			color: #ffffff;
			background-color: #000000;
		}
		.header{
			border: 3px solid black;
			width: 100%;
			margin: auto;
			height: 150px;
			background-color: #545252;
		}
		.footer{	
			border: 3px solid black;
			width: 100%;
			margin-bottom: 0;
			height: fit-content;
			padding: 5vh;
			background-color: #343a40;
		}
		.second-header{
			border-bottom: 3px solid black;
			border-left: 3px solid black;
			border-right: 3px solid black;
			width: 100%;
			height: fit-content;
			padding-top: 10px;
			background-color: #a19f9f;
		}
		.content{
			border-bottom: 3px solid black;
			border-left: 3px solid black;
			border-right: 3px solid black;
			padding: 1vh;
			text-align: center;
			background-color: #c2c2c2;
		}
		.icon-search{
			background: url(../images/icon-search.png) no-repeat scroll right center;
			background-size: 27px;
			background-color: white;
			width: 25vh;
		}
		.form-group > .icon-search:focus{
			width: 40vh;
		}
		.btn-color:hover{
			background-color: #545252;
			color: #ffffff;
			font-weight: bold;
		}
		.cart-img{
			position: relative;
			display: inline-block;
			margin-left: 0;
		}
		.context{
			visibility: hidden;
			width: 25vh;
			background-color: black;
			color: #fff;
			text-align: center;	
			border-radius: 6px;
			padding: 5px 0;
		}
		.pos-tooltip{
			position: absolute;
			top: 60px;
			left: 26vh;
			z-index: 1;
		}
		.pos-tooltip-2{
			position: absolute;
			top: 50px;
			left: 27vh;
			z-index: 1;
		}
		.cart-info:hover .context{
			visibility: visible;
		}
	</style>
</head>
	<body>
		<div class="container-fluid">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
				<a class="navbar-brand" href="#">TokoVisionable</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<?php if($statusForm) { ?>
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link text-white" href="template.php">Barang <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<div class="cart-info">
								<a class="nav-link text-white mr-2" href="template.php?content=shoppingcart.php">Cart</a>
								<span class="context pos-tooltip"><?php echo $status_cart ?></span> 
							</div>
						</li>
						<li class="nav-item">
							<form class="form-inline my-2 my-lg-0" action="/webpro/tubes/template.php?content=tabel_barang.php" method="get">
								<input name="content" type="hidden" value="tabel_barang.php" />
								<input class="form-control mr-sm-2" type="text" name="cari" placeholder="Masukan nama barang" aria-label="Search">
								<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
							</form>
						</li>
					</ul>
					<a class="nav-link text-white" href="logout.php">Logout</a>
					<?php } else { ?>
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link text-white" href="template.php">Barang <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<div class="cart-info">
								<a class="nav-link text-white mr-2" href="template.php?content=shoppingcart.php">Cart</a>
								<span class="context pos-tooltip-2"><?php echo $status_cart ?></span> 
							</div>
						</li>
					</ul>
					<a class="nav-link text-white" href="logout.php">Logout</a>
					<?php } ?>
				</div>
			</nav>
			<div class="content">
				<?php include $vcontent; ?>
			</div>
			<div class="footer">
				<h6 class="footer-style">All Rights Reserved</h6>
			</div>
		</div>
	</body>
</html>