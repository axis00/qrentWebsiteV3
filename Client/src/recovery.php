<?php

	/**
    *
    *   recovery.php
    *
    *   
    *
    *   @author David Paul Brackin
    */

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	require_once 'util/session.php';

	if(isset($_SESSION['user'])){
		header('Location: /');
		die();
	}

	if(isset($_POST['user'])){

		require_once 'util/connectToDb.php';

		$sql = "SELECT username, email FROM `qrent`.`users` WHERE username = ? AND type = 'Client' ";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('s',$_POST['user']);
		$stmt->execute();

		$queryResult = $stmt->get_result();
		if($queryResult->num_rows == 1){
			$recoverid = sha1(uniqid());
			$email = $queryResult->fetch_assoc()['email'];

			$sql = "UPDATE `qrent`.`users` SET `recoveryIdentity`=? WHERE `username`= ? AND type = 'Client'";

			$stmt = $conn->prepare($sql);
			$stmt->bind_param('ss',$recoverid,$_POST['user']);
			$stmt->execute();

			$recoveryUrl = "www.qrent.com/passwordreset?user=".$_POST['user']."&resettoken=".$recoverid;

			// $mail = new PHPMailer(true);
			// try{

			// 	$mail->SMTPOptions = array(
			// 	    'ssl' => array(
			// 	    'verify_peer' => false,
			// 	    'verify_peer_name' => false,
			// 	    'allow_self_signed' => true
			// 	    )
			// 	);

			//     $mail->isSMTP();                                      
			//     $mail->Host = "smtp.gmail.com";  
			//     $mail->SMTPAuth = true;                               
			//     $mail->Username = 'qrentsmtp@gmail.com';                 
			//     $mail->Password = 'qrentadmin12345';                           
			//     $mail->SMTPSecure = 'tls';                            
			//     $mail->Port = 587; 

			//     //Recipients
			//     $mail->setFrom('noreplyr@qrent.com');
			//     $mail->addAddress($email);     // Add a recipient

			//     //Content
			//     $mail->isHTML(true);                                  // Set email format to HTML
			//     $mail->Subject = 'Password Reset';
			//     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			//     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			//     $mail->send();

			// }catch(Exception $e){
			// 	echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
			// }
			echo "<script>alert('Please check your email (".$email.") for recovery directions')</script>";
			echo "<script>window.location.assign('/')</script>";
		}else{
			echo "<script>alert('Error : User not found')</script>";
		}

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
							<h4 style="margin-left: 1rem;">Password Recovery</h4>
							<p>We will send you an email to recover your password</p>
						</div>
						<form method="POST" action="recovery">
							<div class="input-field">
								<input type = "text" name = "user" id="user" class="validate" required="required">
						        <label for="user">Username</label>
						    </div>
						    <div class = "center-align">
				        		<input type = "submit" value = "Recover" class = "btn waves-effect waves-light" style="margin: 1rem;width: 50%">
				        	</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</body>

</html>