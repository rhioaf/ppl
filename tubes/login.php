<?php
    session_start();
    include '../connectDb.php';
    $conn = connDb();
    
    if(isset($_POST["Submit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $query = "SELECT * FROM customer WHERE username='".$username."' AND password='".$password."'";
        $result = $conn->query($query);
        if($result->num_rows > 0){
            $data = $result->fetch_assoc();
            $_SESSION['id'] = $data['id'];
            $_SESSION['username'] = $username;
            header("Location:template.php");
            exit;
        } else{
            header('location:login.php?loginstat="Invalid Username or Password"');
            exit;
        }
    }
    $msg;
    if(isset($_GET['loginstat'])){
        $msg = $_GET['loginstat'];
    }
    if(isset($_GET['logoutstat'])){
        $msg = $_GET['logoutstat'];
    }
?>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <title>PPL 2020</title>
    <link rel="shortcut icon" type="image/x-icon" href="../images/new-icon-ico.ico" />
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
            background-color: white;
        }
        .form-style{
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding
        }
    </style>
</head>
    <body style="background-color:#c2c2c2">
        <div class="container">
            <div class="box">
                <h4 class="font-bold mb-4">Login</h4>
                <?php if(isset($msg)){ ?>
                    <div class="container">
                        <h5 class="alert alert-danger text-center mx-auto mt-1 w-100"><?php echo $msg ?></h5>
                    </div>
                <?php } ?>
                <form method="post" action="">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" minlength="6" maxlength="100" placeholder="Min. 6 karakter" required />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" minlength="8" maxlemgth="50" placeholder="Min. 8 karakter" required />
                    </div>
                    <button type="submit" name="Submit" class="btn btn-success btn-block p-2 mt-4">Submit</button>
                </form>
                <div class="mt-5 text-center">
                    <h6>Belum punya akun?<span style="margin-left: 3px"><a href="registrasi.php">Register</a></span></h6>
                </div>
            </div>
        </div>
    </body>