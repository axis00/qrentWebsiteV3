<?php
        require_once "util/session.php";
?>

    <!DOCTYPE HTML>
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
        
        <link rel="stylesheet" href="/styles/homepage.css">

        <title>Qrent</title>
    </head>

    <body>

        <?php include 'modules/navbar.php';?>

        <div class="container">

            <table class="table table-striped">
                <tr>
                    <th>Item No</th>
                    <th>Item Name</th>
                    <th>Start Date</th>
                    <th>Supposed End Date</th>
                    <th>Actual Return Date</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                </tr>
                <?php
            require_once "util/connectToDb.php";
            
            echo "<center><h1>My Reservations</h1></center>";
            $sql = "SELECT itemno, paymentDate, itemName, itemOwner, paymentAmount, startdate, enddate, returndate FROM qrent.transaction JOIN qrent.Reservation ON (reservation = ReservationID ) NATURAL JOIN qrent.Item WHERE client = ?";

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
