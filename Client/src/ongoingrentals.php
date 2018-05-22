<?php

	/**
    *   reservations.php
    *
    *   A page mean to show the rentals of the logged in user
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

        $rentals = getClientRentals($_SESSION['user']);

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
        <link rel="stylesheet" href="/styles/ongoing.css">

	</head>
	<body>

		<?php 
            include_once "modules/navbar.php";
        ?>

        <div class="container">
            <div class="row">
                <h3>On Going Rentals</h3>
            </div>
            <div class = "rows">
                <div class = "col l9">
                    <?php

                        foreach($rentals as $r){
                            echo generateClientRentals($r);
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

                        if(count($rentals) < $pageCount){
                            echo '<a>Next<i class="material-icons">navigate_next</i></a>';
                        }else{
                            echo '<a href= '.$url.'&page='.($page + 1).'>Next<i class="material-icons">navigate_next</i></a>';
                        }

                    ?>
                </div>
            </div>
        </div>
        <div id="return-modal" class="modal">
                <form id = "returnForm">
                    <div class="modal-content">
                        <h4>Return this item with a review</h4>
                        <div class="input-field col s12">
                            <textarea name="reviewText" id="review-text" class="materialize-textarea"></textarea>
                            <label for="review-text">Write a Review For this item</label>
                        </div>
                        <p class="range-field">
                            <label for="rangeRating">Rate this product (slide)</label>
                            <input name = "rating" type="range" id="rangeRating" min="0" max="100" oninput="updateTextInput(this.value);" required="required">
                            <span class="center-align" id="ratingText" value="Rating">50</span><span>%</span>
                            <input id = "resNumber" name = "resId" type = "hidden" >
                            <input id = "itemNumber" name = "itemno" type = "hidden" >
                            <div class="center-align">
                                  <input type="submit" class="btn itemBtn center-align" value="Return Item" id="reviewSubmit">
                                  <input type="reset" value="cancel" class="btn modal-close itemBtn" id = "cancelBtn">
                            </div>
                        </p>

                    </div>
                </form>
            </div>
        <script src="scripts/rentals.js"></script>

	</body>
</html>