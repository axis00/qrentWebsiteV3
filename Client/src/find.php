<?php

	/**
    *   find.php
    *
    *   Displays the search results of the query
    *
    *   @author David Paul Brackin
    */

	include_once "util/userSession.php";
    include_once "util/connectToDb.php";
    include_once "util/search.php";
    include_once "util/generators.php";

	if(isset($_GET['q'])){

		$items = searchForItems($_GET['q']);

	}else{
		header("Location: /");
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

        <!--Custom Css-->
        <link href="styles/search.css" rel="stylesheet">

    </head>

    <body>
        <?php 
            include_once "modules/navbar.php";
        ?>

        <div class = "container">
        	<div class = "row">
	        	<div class = "col l3">
	        		<div class = "card">
	        			asdf
	        		</div>
	        	</div>
	        	<div class = "col l9">

	        	<?php

	        		foreach ($items as $i) {
	        			echo generateItemSearchResult($i);
	        		}

	        	?>

	        	</div>
        	</div>

        </div>

    </body>

</html>

