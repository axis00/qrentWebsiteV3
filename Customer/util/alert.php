<?php
	$alertQuery = "SELECT status FROM users WHERE username = '$session_username' ";
	$results = mysqli_query($conn, $alertQuery);
    $row = mysqli_fetch_array($results, MYSQLI_ASSOC); 
    $status = $row['status'];
    
    if ($status == "pending") {
    	echo "
    		<div class='alert alert-danger' role='alert'>
  				<strong>Notification!</strong> Your account is not yet approved.
			</div>";
    }
?>