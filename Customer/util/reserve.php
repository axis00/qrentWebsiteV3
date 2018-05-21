<?php

  session_start();

  $_SESSION['user'];

  if(isset($_POST['resId']) && isset($_POST['startdate']) && isset($_POST['duration']) && isset($_SESSION['user'])){

    require "../php/connectToDb.php";

    $client = $_SESSION['user'];

    $itemno = $_POST['resId'];

    $duration = $_POST['duration'];
    $startdate = $_POST['startdate'];

    $sql = "INSERT INTO Reservation (itemno, status, requestdate,startdate, enddate, duration, client) VALUES ($itemno, 'pending',NOW(), startdate ,DATE_ADD(DATE('$startdate'), INTERVAL $duration DAY), $duration, '$client')";

    if ($conn->query($sql)) {
        header('Location: /');
        echo '<script>alert("Successfully made Reservation")</script>';
        die();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

  }

?>

