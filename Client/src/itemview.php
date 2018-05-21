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

        <title>Qrent</title>
	</head>
	<body>
		<div class="nav-container">
            <?php include 'modules/navbar.php';?>
        </div>

        

        <div class="container">
        	<h2 id = "itemViewHeader">Item View</h2>
		    <div class="card">
		    	<div class="carousel carousel-slider">
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
		                				echo "<div class = 'carousel-item valign-wrapper'><img class='materialboxed' width = '100%' src = '/util/itemimage.php?img=".$imgRow['itemimageid']."'></div>";
		                			} 

		                		}else{
		                			die();
		                		}
		                	?>
		        </div>
		        <div class="divider"></div>
		        <div class="row">
			        <div class="col m8" id="itemName"><?php echo $res['itemName']; ?></div>
			        <div class="col m4" id="itemRentPrice"><?php echo $res['itemRentPrice'] ?> PHP/DAY</div>
			        <div class="col m8" id="itemBrand"><?php echo $res['itemBrand']; ?></div>
			        <div class="col m4" id="itemCondition"><?php echo $res['itemCondition'] ?></div>
			        <div class="col m8" id="itemDesc"><?php echo $res['itemDescription']; ?></p> </div>
			        <div class="col m4" id="itemReview"><a class="waves-effect waves-light btn modal-trigger" href="#review-modal">Review</a></div>
		        </div>
		        <div class="center-align itemBtn">
		           <td> <button class='waves-effect waves-light btn-large btnReserve' id="reserve" data-resId=".$row['itemno'].">Reserve</button> </td>
		        </div>
		    </div>

			  <!-- review modal -->
		    <div id="review-modal" class="modal">
		    	<form>
				    <div class="modal-content">
				      	<h4>Review This Item</h4>
				      	<div class="input-field col s12">
				          	<textarea id="review-text" class="materialize-textarea"></textarea>
				          	<label for="review-text">Review</label>
				        </div>
				      	<p class="range-field">
					      	<input name = "rating" type="range" id="rangeRating" min="0" max="100" oninput="updateTextInput(this.value);" />
					      	<label for="rangeRating">Rate this product (slide)</label>
					      	<input name = "itemno" value= <?php echo $_GET['q']?> type = "hidden" >
					      	<div class="center-align">
							      <p class="center-align" id="textInput" value="Rating">50</p>
							      <input type="submit" class="btn itemBtn center-align" value="Submit Review" id="reviewSubmit">
							      <input type="reset" value="cancel" class="btn modal-close itemBtn" id = "cancelResBtn">
						  	</div>
						</p>

				    </div>
				</form>
		    </div>
		
		<?php 
			if(isset($_SESSION['user'])){
				echo '	<div id = "reserveFormCont" style="display: none">
				            <div class = "card">
				                <h2 class = "card-title center-align" id="reserve-title">Reservation Form</h2>
				                <form action="/reserve.php" method="POST">
				                	<div class="container">
				                    <input id = "resid" name = "resId" type = "hidden" value = '.$_GET['q'].'>
				                    <label for="startdate">Start Date</label>
				                	<input class="datepicker" type="text" name = "startdate" id = "startdate" required="required">
				                    <label for="duration">Rental Duration</label>
				                    <input class="form-control" type="number" name = "duration" id = "duration" required="required">
				                    	<div class="center-align">
						                    <input type="submit" value="Reserve" class="btn itemBtn">
						                    <input type="reset" value="cancel" class="btn itemBtn" id = "cancelResBtn">
						            	</div>
				                    </div>
				                </form>
				            </div>
				        </div>';
			}else{
				echo '	<div id = "reserveFormCont" style="display:none">
							<div class = "red lighten-1 card card-panel">
								<div class = "container">
									<h4 class = "white-text center-align">You must be logged in! <a href = "/login.php">Login here</a></h4>
								</div>
							</div>
						</div>';
			}
		?>

     </div>
        <script src="./scripts/reserve.js"></script>

	</body>
</html>