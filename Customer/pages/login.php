<?php
//    JavaScript for Index
    echo"<script type='text/javascript' src='../scripts/alert.js'></script>";
    
    require "../util/connectToDb.php";
    session_start();

    if(isset($_SESSION['user'])){
        header('Location:/pages/home.php');
        die();
    }

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $query = "SELECT username,password FROM users WHERE username = '$username'";
        $results = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($results, MYSQLI_ASSOC); 
        $count = mysqli_num_rows($results);
        $passwordVerify = $row['password'];
        
        if($count == 1){
                if(password_verify($password, $passwordVerify)){
                $_SESSION['user'] = $username;
                echo "<script>loginSuccess()</script>";
                }else{
                echo "<script>invalidPassword()</script>";
                }
            }else{
                echo "<script>invalidUser()</script>";
            }
        }

?>

<!DOCTYPE html>
<html>
    <head>
        <!--CSS-->
        <link rel="stylesheet" href="../styles/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Qrent</title>
    </head>
    
    <body style="margin-top: 7vh;">
        <div class="valign-wrapper center-align">
            <div class="row white" id="login-form">
                <form method="post" class="col s12">
                    <br>
                    <img src="../images/qrent-logo.png" id="logo"><br><br><br>
                    
                    <div class="input-field col s12">
                        <input type="text" class="validate" id="user" name="username" placeholder="Username"><br>
                        <label for="user">Username</label>
                    </div>
                    
                    <div class="input-field col s12">
                        <input type="password" class="validate" id="pass" name="password" placeholder="Password"><br>
                        <label for="pass">Password</label> 
                    </div>
                    <button type="submit" class="btn waves-effect waves-light">Login</button><br><br>
                    <p class="center-align">Not yet registered? <a href="pages/register.php">Register here.</a></p>
                </form>
            </div>
        </div>
        
    </body>
</html>