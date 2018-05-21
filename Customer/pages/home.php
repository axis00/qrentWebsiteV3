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
        <?php include '../util/alert.php'?>

        <div class="container mt-5">
            <center><img src="../images/qrent-logo.png" width="200px" height="200px" style="margin-top:100px; float: 0;"/></center>
            <form action = "./search.php" method="GET">
                <div class="input-group mt-5">
                    <input type="text" class="form-control" placeholder="Search an item..." style="padding:15px;">
                    <div class="input-group-append">
                        <input type = "submit" class="btn btn-outline-secondary" value="Search">
                    </div>
                </div>
            </form>
        </div>
    </body>

</html>