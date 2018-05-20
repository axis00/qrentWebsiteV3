<?php
    
    /**
    *
    *   itemview.php
    *
    *   A php file meant query an item from the datebase and display said item in html
    *
    *   @author David Paul Brackin
    */

?>

<!DOCTYPE html>
<html>
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

        <title>ent</title>
	</head>
	<body>
		<div class="nav-container">
            <?php include 'modules/navbar.php';?>
        </div>

        <div class="container">
        	<h2 id = "itemViewHeader">Item View</h2>

        	<div class="carousel carousel-slider">
        </div>
</body>
</html>

        
