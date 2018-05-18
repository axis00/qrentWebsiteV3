<?php

	/**
	*
	*	connectToDb.php
	*
	*	A php file meant to be included in all pages that require a connection to the qrent database
	*
	*	@author David Paul Brackin
	*/

    $url = 'qrentdb.cqmw41ox1som.ap-southeast-1.rds.amazonaws.com';
    $user = 'root';
    $pass = 'letmein12#';
    $db = 'qrent';

    $conn = new mysqli($url,$user,$pass,$db);

    if($conn->connect_error){
        die("Can't connect to database");
    }
?>