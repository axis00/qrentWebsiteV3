<?php

	/**
    *   reservations.php
    *
    *   A page mean to show the reservations of the logged in user
    *
    *   @author David Paul Brackin
    */

    include_once "util/session.php";
    include_once "util/helpers.php";
    include_once "util/generators.php";


    if(isset($_SESSION['user'])){

        $cond = "";
        $page = 0;
        $pageCount = 10;

        $reservations = getClientReservations($_SESSION['user']);

    }else{
    	header('Location: /login.php');
    	die();
    }


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

        <link rel="stylesheet" href="/styles/style.css">

	</head>
	<body>

		<?php 
            include_once "modules/navbar.php";
        ?>

        <div class="container">
            <div class="row">
                <h3>Reservations</h3>
            </div>
            <div class = "rows">
                <div class = "col l9">
                    <?php

                        foreach($reservations as $r){
                            echo generateReservation($r);
                        }

                    ?>
                </div>
            </div>
            <div class = "row center-align page-nav">
                <div class="col" style = "float: none">
                    <?php
                        if($page <= 1){
                            echo '<a><i class="material-icons">navigate_before</i>Prev</a>';
                        }else{
                            echo '<a href= '.$url.'&page='.($page - 1).'><i class="material-icons">navigate_before</i>Prev</a>';
                        }

                        if(count($reservations) < $pageCount){
                            echo '<a>Next<i class="material-icons">navigate_next</i></a>';
                        }else{
                            echo '<a href= '.$url.'&page='.($page + 1).'>Next<i class="material-icons">navigate_next</i></a>';
                        }

                    ?>
                </div>
            </div>
        </div>

        <div id="cancel-modal" class="modal">
            <h3>Cancel Your Reservation</h3>
            <form>
                <input type="hidden" id = "itemToCancel" name = "itemToCancel" value = "">
                <div class="input-field col s12">
                    <textarea name = "cancel-reason" id="cancel-text" class="materialize-textarea" required="required"></textarea>
                    <label for="review-text">Please Provide a reason</label>
                </div>
                <div>
                    <input type = "submit" class="btn itemBtn center-align" value = "Cancel Reservation">
                </div>
            </form>
        </div>

        <script src="scripts/reservations.js"></script>

	</body>
</html>