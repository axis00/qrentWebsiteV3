<?php
    $url = 'qrentdb.cqmw41ox1som.ap-southeast-1.rds.amazonaws.com';
    $user = 'root';
    $pass = 'letmein12#';
    $db = 'qrent';

    $conn = new mysqli($url,$user,$pass,$db);

    if($conn->connect_error){
        die("Can't connect to database");
    }
?>