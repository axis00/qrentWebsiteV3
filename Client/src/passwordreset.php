<?php 

	/**
    *
    *   passwordreset.php
    *
    *   
    *
    *   @author David Paul Brackin
    */

    require_once 'util/session.php';

	if(isset($_SESSION['user'])){
		header('Location: /');
		die();
	}

	if(isset($_POST['user']) && isset($_POST['resettoken'])){
		
		require_once 'util/connectToDb.php';

		$sql = "SELECT recoveryIdentity FROM `qrent`.`users` WHERE username = ? AND type = 'Client' ";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$_POST['user']);
		$stmt->execute();

		$queryResult = $stmt->get_result();

		if($queryResult->num_rows == 1){

			$tok = $queryResult->fetch_assoc()['recoveryIdentity'];
			
			if($tok == $_POST['resettoken']){
				
				//valid reset
				$password = $_POST['newpass'];
				$hashedpassword = password_hash($password, PASSWORD_DEFAULT);

				$sql = "UPDATE `qrent`.`users` SET `password`= ?,`recoveryIdentity`= NULL WHERE `username`= ? AND type = 'Client' ";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param('ss',$hashedpassword,$_POST['user']);
				$stmt->execute();

				if(!$stmt){
					echo '<script>alert("something went wrong, please try again ")</script>';
					header('Location: /recovery');
					die();
				}else{

					echo "<script>alert('Your password has been changed, Please Login')</script>";

					header('Location: /login.php');
					die();
				}
				

			}else{
				header('Location: /');
				die();
			}

		}else{

			header('Location: /');
			die();

		}

	}else if(isset($_GET['user']) && isset($_GET['resettoken'])){

		require_once 'util/connectToDb.php';

		$sql = "SELECT recoveryIdentity FROM `qrent`.`users` WHERE username = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$_GET['user']);
		$stmt->execute();

		$queryResult = $stmt->get_result();

		if($queryResult->num_rows == 1){

			$tok = $queryResult->fetch_assoc()['recoveryIdentity'];
			
			if($tok != $_GET['resettoken']){
				header('Location: /');
				die();
			}

		}else{

			header('Location: /');
			die();

		}

	}else{
		header('Location: /');
		die();
	}


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
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

        <link rel="stylesheet" href="./styles/style.css">
        <link rel="stylesheet" href="./styles/recovery.css">
	</head>
	<body>
		<div class = "valign-wrapper" style="height: 100vh">
			<div class="container">
				<div class = "row">
					<div class = "col l4 center-col recovery-form-cont card card-panel">
						<div class = "card-title">
							<div class = "form-header valign-wrapper">
								<img src = 'images/qrent-logo.png'>
								<h2>Qrent</h2>
							</div>
							<h4 style="margin-left: 1rem;">Enter a new password</h4>
						</div>
						<form method="POST" action="passwordreset">
							<div class="input-field">
								<input type = "password" name = "newpass" id="user" class="validate" required="required">
						        <label for="user">New Password</label>
						    </div>
						    <div class="input-field">
								<input type = "password" id="user" class="validate" required="required">
						        <label for="user">Confirm Password</label>
						    </div>
						    <input type = "hidden" name = "resettoken" value=<?php if(isset( $_GET['resettoken'])) echo $_GET['resettoken']; ?> >
						    <input type = "hidden" name = "user" value=<?php if(isset( $_GET['user'])) echo $_GET['user'] ?> >
						    <div class = "center-align">
				        		<input type = "submit" value = "Change Password" class = "btn waves-effect waves-light" style="margin: 1rem;width: 50%">
				        	</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</body>

</html>