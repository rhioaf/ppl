<!-- Rhio Adjie Fabian - 181511064 -->

<?php 
    session_start();
    if(isset($_POST['login'])){
        $username = "ali";
        $password = "abcd";
        if($_POST['username'] == $username && $_POST["password"] == $password){
            $_SESSION['username'] = $username;
            header('location:template.php');
        } else{
            $err = "Login Failed";
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
            <form action="" method="post">
                <label>Username</label> 
                <input type="text" class="margin-2" name="username" id="username" required />
                <br/>
                <label>Password</label>
                <input type="password" name="password" class="margin-2" id="password" required />
                <br/>
                <button name="login" type="submit">submit</button>
            </form>
        </div>
    </body>
</html>