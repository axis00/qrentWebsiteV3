<script type="text/javascript">
	function nullField(){
		alert("All Fields Must be filled");
	}

	function incorrectPassword(){
		alert("Incorrect Password");
	}

	function mismatchedPassword(){
		alert("Your password did not matched");
	}

	function samePassword(){
		alert("Your new password is same as the current password");
	}

	function success(){
		alert("Successfully changed password");
	}
</script>

<!DOCTYPE html>
<html>

	<?php
	require_once 'util/session.php';
	require_once 'util/connectToDb.php';

		if (isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['verify_password'])){
			$current_password =  mysqli_real_escape_string($conn, $_POST['current_password']);
			$new_password =  mysqli_real_escape_string($conn, $_POST['new_password']);
			$verify_password =  mysqli_real_escape_string($conn, $_POST['verify_password']);

			if ($current_password == null || $new_password == null || $verify_password == null){
				echo "<script>nullField()</script>";
			}else {
				$query = "SELECT password FROM users WHERE username = '$session_username'";
				$results = mysqli_query($conn, $query);
        		$row = mysqli_fetch_array($results, MYSQLI_ASSOC); 
        		$count = mysqli_num_rows($results);
        		$oldPassword = $row['password'];

        		if ($count == 1){
        			if (password_verify($current_password, $oldPassword)) {
        					if ($new_password != $verify_password) {
        						echo "<script>mismatchedPassword()</script>";
        					}elseif(password_verify($new_password, $oldPassword)){
        							echo "<script>samePassword</script>";
        						}else {
        						$new_password = password_hash($new_password, PASSWORD_DEFAULT);
        						$passwordQuery = $conn->prepare("UPDATE users  SET password = '$new_password' WHERE username = '$session_username'");

        							if(!$passwordQuery->execute()){
        								echo $passwordQuery->error();
        							} else{
        								echo "<script>success()</script>";
        							}
        					}
        			}else {
        				echo "<script>incorrectPassword()</script>";
        			} 
        		}
			}
		}
	?>

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/styles/bootstrap-4.0.0/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/styles/style.css">

    <!--Jquery-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" 
        crossorigin="anonymous"></script>

    <!-- Materialize-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

    <link rel="stylesheet" href="/styles/style.css">
    <link rel="stylesheet" href="/styles/ongoing.css">

	<title>Qrent</title>
</head>
<body>
	<?php include "modules/navbar.php" ?>

	<div class="container">
		<div class = "row">
			<form method="post">
				<div class="form-group">
					<h1>Change Password</h1> <br>
					Old Password: <input type="password" class="form-control" name="current_password" placeholder="Password"> <br>
					New Password: <input type="password" class="form-control" name="new_password" placeholder="New Password"> <br>
					Re-type New Password: <input type="password" class="form-control" name="verify_password" placeholder=" Re-type NewPassword"> <br>

					<input type="submit" class="btn btn-primary" name="changePassword" value="Submit">
				</div>
			</form>
		</div>
	</div>
</body>
</html>