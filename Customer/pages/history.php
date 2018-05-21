<?php
        require "../php/session.php";
?>

    <!DOCTYPE HTML>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../styles/style.css">
        <link rel="stylesheet" href="../styles/bootstrap-4.0.0/dist/css/bootstrap.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <title>Qrent</title>
    </head>

    <body style="background-color: #F7EBEC;">
        <div class="container" style="margin-top:5%;">
            <div class="nav-container">
                <?php include 'nav.html';?>

            </div>

            <table class="table table-striped">
                <tr>
                    <th>Reservation ID</th>
                    <th>Item No</th>
                    <th>Item Name</th>
                    <th>Request Date</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Duration</th>
                    <th>Status</th>
                </tr>
                <?php
            require "../php/connectToDb.php";
            
            echo "<center><h1>My Reservations</h1></center>";
            $sql = "SELECT Reservation.ReservationID, Reservation.itemno, Item.itemName, Reservation.requestdate, Reservation.startdate, Reservation.enddate, Reservation.duration, Reservation.status FROM qrent.Reservation inner join Item ON Reservation.itemno=Item.itemno WHERE client='$checkUser';";
            $results = mysqli_query($conn, $sql);
                if($results-> num_rows > 0){
                
                    while($row = mysqli_fetch_array($results)){
                        echo "<tr><td scope='row'>". $row["ReservationID"] . "</td><td>". $row["itemno"] . "</td><td>" . $row["itemName"] . "</td><td>" . $row["requestdate"] . "</td><td>" .$row["startdate"]. "</td> <td>" .$row["enddate"]. "</td><td>" .$row["duration"]. "</td><td>" .$row["status"]. "</td>";
                    }
                }
                    else{
                        echo "You have no reservations";
                    }
                ?>
            </table>
        </div>
    </body>

    </html>
