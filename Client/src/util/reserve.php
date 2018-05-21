<?php

	require_once 'session.php';

	if(isset($_SESSION['user'])){

		if(isset($_POST['resId']) && isset($_POST['startdate']) && isset($_POST['duration'])){

			require_once 'connectToDb.php';

			global $conn;

			$client = $_SESSION['user'];

		    $itemno = $_POST['resId'];

		    $duration = $_POST['duration'];
		    $startdate = $_POST['startdate'];

		    $sql = "INSERT INTO `qrent`.`Reservation` (itemno, status, requestdate,startdate, enddate, duration, client) VALUES ( ? , 'pending',NOW(), DATE(?) ,DATE_ADD(DATE(?), INTERVAL ? DAY), ?, ?)";
		    $stmt = $conn->prepare($sql);
		    $stmt->bind_param('issiis',$itemno,$startdate,$startdate,$duration,$duration,$client);
		    $stmt->execute();

		    if(!$stmt){
		    	echo htmlspecialchars($conn->error);
		    }else{
		    	header('Location: /Reservations');
		    	die();
		    }

		}

	}else{
		header('Location: /login');
		die();
	}

?>