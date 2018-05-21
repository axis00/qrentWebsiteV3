<!DOCTYPE html>

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../styles/bootstrap-4.0.0/dist/css/bootstrap.css">
        <link rel="stylesheet" href="../styles/style.css">
        <title>Qrent</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="narbar-brand" href="#"><img  src="../images/qrent-logo.png"></a>
        
        <div class="dropdown">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" id="menu">Noriel</button>
            <div class="dropdown-menu" aria-labelledby="menu">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Logout</a>
            </div>
        </div>
    </nav>
    
    <table class="table table-borderless">
        <tr>
            <th>Item No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Brand</th>
            <th>Owner</th>
            <th>Rentprice</th>
            <th na>Condition</th>
        </tr>
        
        <?php
            require "../php/connectToDb.php";
            
            $sql = "SELECT * FROM Item";
            $results = mysqli_query($conn, $sql);
            if($results-> num_rows > 0){
                
                while($row = mysqli_fetch_array($results)){
                    $itemName = $row['itemName'];
                    echo "<tr><td scope='row'>$itemName</td><td>". $row["itemName"] . "</td><td>" . $row["itemDescription"] . "</td><td>" . $row["itemBrand"] . "</td><td>" .$row["itemOwner"]. "</td> <td>" .$row["itemRentPrice"]. "</td><td>" .$row["itemCondition"]. "</td>" ;
                }
                
            
        ?>
    </table>
    
    <?php
                if(isset($_POST['item'])){
                $itemName = $_POST['item'];
                echo "<h1>$itemName</h1>";
            }
            }
    ?>
</body>

<?php
    require "../php/session.php"
?>