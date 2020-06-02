<!-- Rhio Adjie Fabian - 181511064 -->

<?php
    include 'connectDb.php';
    $conn = connDb();
    session_start();
    if(isset($_POST['login'])){
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $dataUser =  $conn->query("select * from admin where username= '$username' and password= '$password'");
        $status = mysqli_num_rows($dataUser);
        if($status > 0){
            $_SESSION['username'] = $username;
            $_SESSION['index'] = 1;
            header('location:template.php');
            exit;
        } else{
            header('location:login_pake_database.php?status="Akun tidak terdaftar"');
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PPL 2020</title>
    </head>
    <style>
        .card{
            width: auto;
            height: auto;
            border: 3px solid black;
            margin: 10px;
            padding: 10px;
            text-align: center;
        }
        .margin-2{
            margin: 10px;
        }
    </style>
    <body>
        <div class="card">
            <?php 
                if(isset($_GET['status'])) { ?>
                <h3 style="color:red;"><?php echo $_GET['status']; ?></h3>
            <?php } ?>
            <h2 class="text-center" style="bold;">Login Form</h2>
            <form action="" method="post">
                <!-- <label>Id Pegawai</label>
                <input type="text" class="margin-2" name="id" id="id" required />
                <br/> -->
                <label>Username</label> 
                <input type="text" class="margin-2" name="username" id="username" required />
                <br/>
                <label>Password</label>
                <input type="password" name="password" class="margin-2" id="password" required />
                <br/>
                <button name="login" type="submit">Submit</button>
            </form>
        </div>
    </body>
</html>