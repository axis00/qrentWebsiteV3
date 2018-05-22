<?php

	require_once 'session.php';

	if(isset($_SESSION['user'])){

		if(isset($_POST['itemno']) && isset($_POST['resId']) && isset($_POST['reviewText']) && isset($_POST['rating'])){
			
			$sql = "UPDATE `qrent`.`Reservation` SET `status`='endedrental',`returndate`= NOW() WHERE `ReservationID`= ?";

			$stmt = $conn->prepare($sql);
			$stmt->bind_param('i',$_POST['resId']);
			$stmt->execute();

			if(!$stmt){
				echo 'error';
			}else{

				$sql = "INSERT INTO `qrent`.`itemRating` (`user`, `rating`, `itemno`, `review`) VALUES (?, ?, ?, ?)";

				$stmt = $conn->prepare($sql);
				$stmt->bind_param('siis',$_SESSION['user'],$_POST['rating'],$_POST['itemno'],$_POST['reviewText']);
				$stmt->execute();

				if(!$stmt){
					echo "error";
				}else{
					echo "success";
				}

			}

		}

	}else{
		header('Location: /');
		die();
	}

?>