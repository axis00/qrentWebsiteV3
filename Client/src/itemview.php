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
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

        <!-- Materialize-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

        <link rel="stylesheet" href="./styles/style.css">
        <link rel="stylesheet" href="./styles/itemview.css">

        <title>Qrent</title>
    </head>

    <body>
        <div class="nav-container">
            <?php include 'modules/navbar.php';
            ?>
        </div>



        <div class="container">
            <?php
                $minDate = date("Y-m-d");
                $minDate = date("Y-m-d", strtotime($minDate . '+1 day'));
            ?>
                <h2 id="itemViewHeader">Item View</h2>
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
                        <div class="col m8" id="itemName">
                            <?php echo $res['itemName']; ?>
                        </div>
                        <div class="col m4" id="itemRentPrice">
                            <?php echo $res['itemRentPrice'] ?> PHP/DAY</div>
                        <div class="col m8" id="itemBrand">
                            <?php echo $res['itemBrand']; ?>
                        </div>
                        <div class="col m4" id="itemCondition">
                            <?php echo $res['itemCondition'] ?>
                        </div>
                        <div class="col m8" id="itemDesc">
                            <?php echo $res['itemDescription']; ?> </div>
                        <div class="col m4" id="itemReview"><a class="waves-effect waves-light btn modal-trigger" href="#review-modal">Review</a></div>
                    </div>
                    <div class="center-align itemBtn">
                    	<!--- check if already reserved -->
                        <td> <button class='waves-effect waves-light btn-large btnReserve modal-trigger' href="#reserve-modal" id="reserve" data-resId=".$row['itemno'].">Reserve</button> </td>
                    </div>
                </div>

                <!-- review modal -->


                <?php 
			if(isset($_SESSION['user'])){
				$itemno = $_GET['q'];
			echo
			'<div id="review-modal" class="modal">
		    	<form id = "reviewForm">
				    <div class="modal-content">
				      	<h4>Review This Item</h4>
				      	<div class="input-field col s12">
				          	<textarea name="reviewText" id="review-text" class="materialize-textarea"></textarea>
				          	<label for="review-text">Write a Review For this item</label>
				        </div>
				      	<p class="range-field">
					      	<label for="rangeRating">Rate this product (slide)</label>
					      	<input name = "rating" type="range" id="rangeRating" min="0" max="100" oninput="updateTextInput(this.value);" />
					      	<span class="center-align" id="ratingText" value="Rating">50</span><span>%</span>
					      	<input name = "itemno" value= '.$itemno.' type = "hidden" >
					      	<div class="center-align">
							      <input type="submit" class="btn itemBtn center-align" value="Submit Review" id="reviewSubmit">
							      <input type="reset" value="cancel" class="btn modal-close itemBtn" id = "cancelResBtn">
						  	</div>
						</p>

				    </div>
				</form>
		    </div>';
		    echo 
		    '<div id="reserve-modal" class="modal">
		    	<form action="/util/reserve.php" method="POST">
		    		<div class="modal-content">
		    			<div id = "reserveFormCont" style="display: none">
				            <div>
				                <h2 class = "center-align" id="reserve-title">Reservation Form</h2>
			                	<div class="container">
			                    
			                    <label for="startdate">Start Date</label>
			                	<input class="datepicker" type="date" name = "startdate" required="required" min='.$minDate.' value=" ">
                                
			                    <label for="duration">Rental Duration</label>
			                    <input class="form-control" type="number" name = "duration" id = "duration" required="required" min="1">
			                    <input id = "resid" name = "resId" type = "hidden" value = '.$itemno.'>
                                
			                    	<div class="center-align">
					                    <input type="submit" value="Reserve" class="btn itemBtn">
					                    <input type="reset" value="cancel" class="btn itemBtn modal-close" id = "cancelResBtn">
					            	</div>
			                    </div>
				            </div>
				        </div>
				    </div>
				</form>
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
        <?php include 'modules/footer.php';?>
        <script src="./scripts/itemView.js"></script>
    </body>

    </html>
