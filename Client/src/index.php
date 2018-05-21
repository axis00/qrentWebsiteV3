<?php

    /**
    *   index.php
    *
    *   Homepage of www.qrent.com
    *
    *   @author David Paul Brackin
    */

    include_once "util/session.php";
    include_once "util/connectToDb.php";
    include_once "util/search.php";
    include_once "util/generators.php";
    include_once "util/helpers.php";

?>

<!DOCTYPE html>
<html>

    <head>
        <!--Jquery-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" 
            crossorigin="anonymous"></script>

        <!-- Materialize-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

        <link rel="stylesheet" href="/styles/homepage.css">

    </head>

    <body>
        <?php 
            include_once "modules/navbar.php";
        ?>


        <div class = "container">
            <h3>Featured Items</h3>
            <div class = "row">
                <?php

                    $featured = getFeaturedItems();

                    echo generateItemShowCase($featured);
                ?>
            </div>

        </div>

        <ul class="sidenav" id="mobile-usermenu">
            <?php

                if(isset($_SESSION['user'])){
                    echo "  <li><a href='/profile.php?=$session_user'>Profile</a></li>
                            <li><a href='/logout.php'>Logout</a></li>";
                }else{
                    echo "  <li><a href='/login.php'>Login</a></li>";
                }

            ?>
            
        </ul>

    </body>

    <script src = "/scripts/homepage.js"></script>

</html>