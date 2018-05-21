<!DOCTYPE HTML>
<html>

<?php
    require "../util/session.php";
?>

    <head>
        <!--CSS-->
        <link rel="stylesheet" href="../styles/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Qrent</title>
    </head>

    <body style="background-color: #F7EBEC;">
        <?php include '../modules/navbar.php'?>
        
        <div class="container" style="margin-top:5%;">
            <table class="table table-bordered">
                <center><h1>My Profile</h1></center>
                <tr>
                    <th scope="col">Username</th>
                    <td><?php echo "$session_username";?></td>
                </tr>
                
                <tr>
                    <th scope="col">First Name</th>
                    <td><?php echo "$session_first";?></td>
                </tr>
                
                <tr>
                    <th scope="col">Last Name</th>
                    <td><?php echo "$session_last";?></td>
                </tr>
                
                <tr>
                    <th scope="col">Birthdate</th>
                    <td><?php echo "$session_birth";?></td>
                </tr>
                
                <tr>
                    <th scope="col">Address</th>
                    <td><?php echo "$session_address";?></td>
                </tr>
                
                <tr>    
                    <th scope="col">Contact Number</th>
                    <td><?php echo "$session_contact";?></td>
                </tr>
                    
                <tr>
                    <th scope="col">Email Address</th>
                    <td><?php echo "$session_email";?></td>
                </tr>    
            </table>
                
            <br><center><a href="../util/editProfile.php"><input type="submit" class="btn btn-primary" value="Edit Profile Information"></a></center>
        </div>
    </body>
</html>
