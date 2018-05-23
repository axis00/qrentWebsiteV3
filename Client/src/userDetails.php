<?php
    include_once "util/connectToDb.php";
    include_once "util/session.php";
?>

<html>
    
    <body>
        <?php
            $userQuery = $_GET['user'];
            $sessionSql = mysqli_query($conn, "SELECT CONCAT(firstname, ', ', lastname) AS name, username, firstname, lastname, CONCAT(addressno, ' ', street,' ', municipality,' ', province) AS address, contactno, email FROM users NATURAL JOIN customers where username = '$userQuery';");
            $row = mysqli_fetch_array($sessionSql, MYSQLI_ASSOC);
            $session_user = $row['name'];
            $session_username = $row['username'];
            $session_first = $row['firstname'];
            $session_last = $row['lastname'];
            $session_address = $row['address'];
            $session_contact = $row['contactno'];
            $session_email = $row['email'];
        ?>
        <table class="table table-bordered">
                <tr>
                    <th scope="col">Username</th>
                    <?php echo "<td>$session_username</td>"?>
                </tr>
                
                <tr>
                    <th scope="col">First Name</th>
                    <td><?php echo "$session_first";?></td>
                </tr>
                
                <tr>
                    <th scope="col">Last Name</th>
                    <td><?php echo "$session_last";?></td>
                </tr>
                
                <tr>
                    <th scope="col">Birthdate</th>
                    <td><?php echo "$session_birth";?></td>
                </tr>
                
                <tr>
                    <th scope="col">Address</th>
                    <td><?php echo "$session_address";?></td>
                </tr>
                
                <tr>    
                    <th scope="col">Contact Number</th>
                    <td><?php echo "$session_contact";?></td>
                </tr>
                    
                <tr>
                    <th scope="col">Email Address</th>
                    <td><?php echo "$session_email";?></td>
                </tr>    
            </table>    
    </body>

</html>