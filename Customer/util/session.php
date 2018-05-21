<?php
    require "connectToDb.php";
    session_start();
    $checkUser = $_SESSION['user'];
    $sessionSql = mysqli_query($conn, "SELECT CONCAT(firstname, ', ', lastname) AS name, username, firstname, lastname, birthdate, CONCAT(addressno, ' ', street,' ', municipality,' ', province) AS address, addressno, street, municipality, province, postalcode, contactno, email FROM users NATURAL JOIN customers where username = '$checkUser';");
    $row = mysqli_fetch_array($sessionSql, MYSQLI_ASSOC);
    $session_user = $row['name'];
    $session_username = $row['username'];
    $session_first = $row['firstname'];
    $session_last = $row['lastname'];
    $session_birth = $row['birthdate'];
    $session_address = $row['address'];
    $session_addressNo = $row['addressno'];
    $session_street = $row['street'];
    $session_municipality = $row['municipality'];
    $session_province = $row['province'];
    $session_postal = $row['postalcode'];
    $session_contact = $row['contactno'];
    $session_email = $row['email'];


    if(!isset($_SESSION['user'])){
        header("location:/");
   }
?>