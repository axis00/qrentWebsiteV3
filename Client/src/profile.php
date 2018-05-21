<!DOCTYPE HTML>
<html>
<?php
    require "util/session.php";
    ?>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--Jquery-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" 
            crossorigin="anonymous"></script>

        <!-- Materialize-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <link rel="stylesheet" href="./styles/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

        <title>Qrent</title>
    </head>

    <body>
        <?php include 'modules/navbar.php' ?>
        
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
                
            <center><a href="../php/editProfile.php"><input type="submit" class="btn btn-primary" value="Edit Profile Information"></a></center>
        </div>
    </body>
</html>
