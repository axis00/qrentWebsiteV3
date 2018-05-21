<?php

	require_once 'util/session.php';

	if(isset($_SESSION['user'])){
		header('Location: /');
		die();
	}

?>

<!DOCTYPE html>
<html>
	<head>

		<!--Jquery-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" 
            crossorigin="anonymous"></script>

        <!-- Materialize-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

        <script src = "scripts/login.js"></script>
        <link rel="stylesheet" type="text/css" href="styles/style.css">

	</head>
	<body>
		<div class = "valign-wrapper" style = "height:100vh">
			<div class = "container">
				<div class = "row">
					<div class = "col l4 m2"></div>
					<div class = "col l4 m8 s12 card card-panel" style="padding: 2rem;">
						<div class = "card-title">
							<div class = "form-header valign-wrapper">
								<img src = 'images/qrent-logo.png'>
								<h2>Qrent</h2>
							</div>
							<h3 style="margin-left: 1rem;">Login</h3>
						</div>
						<form id = "login-form" class = "col l12 m12 s12">
							<div class="input-field col l12 m12 s12">
				          		<input name = "user" id="username" type="text" class="validate" required="required">
				          		<label for="username">Username</label>
				        	</div>
				        	<div class="input-field col l12 m12 s12">
				          		<input name = "password" id="password" type="password" class="validate" required="required">
				          		<label for="password">Password</label>
				        	</div>
				        	<div class = "center-align">
				        		<input type = "submit" value = "Login" class = "btn waves-effect waves-light" style="margin: 1rem;width: 50%">
				        		<a href = "/recovery.php" style="display: block; margin: 1rem;">Forgot password</a>
				        	</div>
						</form>
					</div>
					<div class = "col l4 m2"></div>
				</div>
			</div>
		</div>

	</body>
</html>