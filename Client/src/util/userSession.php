<?php

	/**
	*
	*	userSession.php
	*
	*	A php file meant to be included in all pages that require a user. This was made to create a uniform way to access the logged in user(i.e. using the $user variable)
	*
	*	@author David Paul Brackin
	*/

	session_start();

	$user;

	if(isset($_SESSION['user'])){
		$user = $_SESSION['user'];
	}

?>