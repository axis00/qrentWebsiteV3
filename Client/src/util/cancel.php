<?php


    /**
    *
    *   cancel.php
    *
    *   A php file meant to handle the cancelations of the client
    *
    *   @author David Paul Brackin
    */

	require_once 'session.php';

	if(isset($_SESSION['user'])){

		if(isset($_POST['resToCancel']) && isset($_POST['cancel-reason'])){

			require_once 'connectToDb.php';

			$sql = "UPDATE `qrent`.`Reservation` SET `status` = 'canceled' , `remarks`= ? , `canceledBy`= ? WHERE `ReservationID`= ? ";

			$stmt = $conn->prepare($sql);
			$stmt->bind_param('ssi', $_POST['cancel-reason'],$_SESSION['user'],$_POST['resToCancel']);
			$stmt->execute();

			if(!$stmt){
				echo 'error';
			}else{
				echo 'success';
			}

		}

	}else{
		header('Location: /login.php');
		die();
	}

?>