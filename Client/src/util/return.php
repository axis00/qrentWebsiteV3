<?php

	require_once 'session.php';

	if(isset($_SESSION['user'])){

		if(isset($_POST['itemno']) && isset($_POST['reviewText']) && isset($_POST['rating'])){
			
			

		}

	}else{
		header('Location: /');
		die();
	}

?>