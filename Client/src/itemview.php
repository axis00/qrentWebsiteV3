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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

        <title>Qrent</title>
	</head>
	<body>
		<div class="nav-container">
            <?php include 'modules/navbar.php';?>
        </div>

        <h2 id = "itemViewHeader">Item View</h2>

        <div class="container">
		    <div class="card">
		        <div class="card-img-top" style="height : 30rem; overflow : hidden">
		            <div class="carousel slide" id="carouselControls" data-ride="carousel" style="height : 100%">
		                <div class="carousel-inner" style="height : 100%">
		                	<?php

		                		if(isset($_GET['q'])){
		                			require_once 'util/connectToDb.php';

		                			$sql = "SELECT * FROM Item WHERE itemno = ?";

		                			$stmt = $conn->prepare($sql);
		                			$stmt->bind_param('d',$_GET['q']);
		                			$stmt->execute();

		                			$res = $stmt->get_result()->fetch_assoc();
		                			
		                			$imgSql = "SELECT itemimageid FROM ItemImage WHERE itemno = ?";
		                			$imgStmt = $conn->prepare($imgSql);
		                			$imgStmt->bind_param('d',$res['itemno']);
		                			$imgStmt->execute();

		                			$imgRes = $imgStmt->get_result();

		                			$first = true;
		                			while($imgRow = $imgRes->fetch_assoc()){
		                				if($first){
		                					echo "<div class = 'carousel-item active'><img class = 'card-img-top' src = '/itemimage.php?img=".$imgRow['itemimageid']."'></div>";
		                					$first = false;
		                				}else{
		                					echo "<div class = 'carousel-item'><img class = 'card-img-top' src = '/itemimage.php?img=".$imgRow['itemimageid']."'></div>";
		                				}
		                			}

		                		}else{
		                			die();
		                		}

		                	?>
		                </div>
		                <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>
		            </div>
		        </div>
		        <div class="card-body">
		            <h2 class="card-title"><?php echo $res['itemName']; ?></h2>
		            <h5 class="card-text"><?php echo $res['itemBrand']; ?></h5>
		            <p class="card-text"><?php echo $res['itemDescription']; ?></p>
		            <div class="container">
		                <div class="row">
		                    <div class="col-lg-3">
		                        <h7><?php echo $res['itemRentPrice'] ?> PHP/DAY</h7>
		                    </div>
		                    <div class="col-lg-3">
		                        <h7><?php echo $res['itemCondition'] ?></h7>
		                    </div>
		                    <div>
		                    	<td> <button class='reserveBtn btn btn-success' data-resId=".$row['itemno'].">Reserve</button>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<div id = "reserveFormCont" style="display: none">
          <div class = "card form-group">
                <h2 class = "card-title">Reservation Form</h2>
                <form action="../php/reserve.php" method="POST">
                    <input id = "resid" name = "resId" type = "hidden">
                    <label for="startdate">Start Date</label>
                <input class="form-control" type='date' name = 'startdate' id = 'startdate' required="required">
                    <label for="duration">Rental Duration</label>
                    <input class="form-control" type='number' name = 'duration' id = "duration" required="required">
                    <input type="submit" value="Reserve" class="btn btn-primary">
                    <input type="reset" value="cancel" class="btn btn-danger" id = "cancelResBtn">
                </form>
            </div>
        </div>
        <script src="../scripts/reserve.js"></script>

	</body>
</html>