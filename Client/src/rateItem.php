<?php

	require_once 'util/session.php';

	if(isset($_SESSION['user'])){
		
		if(isset($_POST['reviewText']) && isset($_POST['rating']) && isset($_POST['itemno'])){

			require_once 'util/connectToDb.php';

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

	}else{
		header('Location: /login.php');
		die();
	}
	
?>