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
        
        <!--Custom Css-->
        <link href="styles/search.css" rel="stylesheet">
        <link href="styles/style.css" rel="stylesheet">

        <title>Qrent</title>
    </head>

    <body>

        <?php include 'modules/navbar.php';?>

        <div class="container">

            <table class="table table-striped">
                <tr>
                    <th>Item No</th>
                    <th>Item Name</th>
                    <th>Item Owner</th>
                    <th>Start Date</th>
                    <th>Supposed End Date</th>
                    <th>Actual Return Date</th>
                    <th>Amount</th>
                    <th>Payment Date</th>
                </tr>
                <?php
                    require_once "util/connectToDb.php";

                    $url = "/history";

                    $cond = "";
                    $page = 0;
                    $pageCount = 10;

                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        $cond .= "Limit " . (($page-1) * 10) . "," . $pageCount;
                    }
                    
                    echo "<center><h2>Transactions</h2></center>";

                    $sql = "SELECT sum(paymentAmount) as amount FROM qrent.transaction JOIN qrent.Reservation ON (reservation = ReservationID ) WHERE client = ? and paymentDate IS NULL";

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('s',$_SESSION['user']);
                    $stmt->execute();

                    $amount = 0;
                    $results = $stmt->get_result();
                    while($row = $results->fetch_assoc()){
                        $amount = $row['amount'];
                    }

                    echo '<h3>Total Unpaid Amount : '.$amount.'</h3>';

                    $sql = "SELECT itemno, paymentDate, itemName, itemOwner, paymentAmount, startdate, enddate, returndate FROM qrent.transaction JOIN qrent.Reservation ON (reservation = ReservationID ) NATURAL JOIN qrent.Item WHERE client = ? ".$cond;

                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('s',$_SESSION['user']);
                    $stmt->execute();

                    $results = $stmt->get_result();
                    $resCount = $results->num_rows;
                    if($results->num_rows > 0){
                    
                        while($row = $results->fetch_assoc()){
                            echo "<tr>
                                    <td scope='row'>". $row["itemno"] . "</td>
                                    <td>". $row["itemName"] . "</td>
                                    <td>" . $row["itemOwner"] . "</td>
                                    <td>" . $row["startdate"] . "</td>
                                    <td>" . $row["enddate"] . "</td>
                                    <td>" .$row["returndate"]. "</td>
                                    <td>" .$row["paymentAmount"]. "</td>
                                    <td>" .( $row["paymentDate"] ? $row["paymentDate"] : "Unpaid" ) . "</td>";
                        }

                    }else{
                        echo "You have no reservations";
                    }
                ?>
            </table>

            <div class = "row center-align page-nav">
                <div class="col" style = "float: none">
                    <?php
                        if($page <= 1){
                            echo '<a><i class="material-icons">navigate_before</i>Prev</a>';
                        }else{
                            echo '<a href= '.$url.'&page='.($page - 1).'><i class="material-icons">navigate_before</i>Prev</a>';
                        }

                        if($resCount < $pageCount){
                            echo '<a>Next<i class="material-icons">navigate_next</i></a>';
                        }else{
                            echo '<a href= '.$url.'&page='.($page + 1).'>Next<i class="material-icons">navigate_next</i></a>';
                        }

                    ?>
                </div>
            </div>

        </div>
        
        <?php include 'modules/footer.php';?>

    </body>

    </html>
