<?php

	require_once 'session.php';

	if(isset($_SESSION['user'])){

		if(isset($_POST['itemno']) && isset($_POST['reviewText']) && isset($_POST['rating'])){
			echo $_POST['itemno'];
			echo $_POST['rating'];
			echo $_POST['reviewText'];
		}

	}else{
		header('Location: /');
		die();
	}

?>