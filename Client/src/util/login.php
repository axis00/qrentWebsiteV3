<?php

	if(isset($_POST['user']) && isset($_POST['password'])){

		require_once "userSession.php";
		require_once "connectToDb.php";

		$sql = "SELECT username, password FROM users WHERE username = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$_POST['user']);
		$stmt->execute();

		$result = $stmt->get_result();

		if($result->num_rows == 1){
			$hashedPassword = $result->fetch_assoc()['password'];
			if(password_verify($_POST['password'],$hashedPassword)){
				$_SESSION['user'] = $_POST['user'];
				echo "success";
			}else{
				echo "wrong password";
			}
		}else if($result->num_rows < 1){
			echo "not found";
		}
		

	}

?>