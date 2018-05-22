<?php
    require_once "/util/session.php";
    
    //    JavaScript for Index
    echo"<script type='text/javascript' src='/scripts/alert.js'></script>";

    if(isset($_POST['email']) && isset($_POST['mobileNumber']) && isset($_POST['addressNo']) && isset($_POST['street']) && isset($_POST['municipality']) && isset($_POST['province']) && isset($_POST['postalCode'])){
        $email = $_POST['email'];
        $number = $_POST['mobileNumber'];
        $addressNo = $_POST['addressNo'];
        $street = $_POST['street'];
        $municipality = $_POST['municipality'];
        $province = $_POST['province'];
        $postalCode = $_POST['postalCode'];

        $validationQuery = "SELECT email FROM users WHERE email = '$email'";
        $results = mysqli_query($conn, $validationQuery);
        $row = mysqli_fetch_array($results, MYSQLI_ASSOC); 
        $count = mysqli_num_rows($results);
        $mail = $row['email'];

        $validationQuery2 = "SELECT contactno FROM customers WHERE contactno = '$number'";
        $results = mysqli_query($conn, $validationQuery2);
        $row = mysqli_fetch_array($results, MYSQLI_ASSOC); 
        $count2 = mysqli_num_rows($results);
        $mNumber = $row['contactno'];
       
        if ($count == 1 && $mail != $session_email) {
            echo "<script>takenEmail()</script>";
            }elseif ($count2 == 1 && $mNumber != $session_contact) {   
                echo "<script>takenNumber()</script>";
                }else{
                    $updateUserQuery = $conn->prepare("UPDATE users SET email = '$email' WHERE username = '$session_username' ");
                    $updateCustomerQuery = $conn->prepare("UPDATE customers SET contactno = '$number', addressno = '$addressNo', street = '$street', municipality = '$municipality', province = '$province', postalcode = '$postalCode' WHERE username = '$session_username' ");

                    if(!$updateUserQuery->execute()){
                        echo $updateUserQuery->error();
                        } elseif (!$updateCustomerQuery->execute()) {
                            echo $updateCustomerQuery->error();
                        }
                echo "<script>success()</script>";
             }
    }
?>

<!DOCTYPE HTML>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--Jquery-->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

        <!-- Materialize-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <link rel="stylesheet" href="./styles/style.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

        <!--Icons-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="styles/profile.css" />

        <title>Qrent</title>
    </head>
    
    <body style="background-color: #F7EBEC;">
         <?php include 'modules/navbar.php';?>
        
        <div class="valign-wrapper center-align container">
            <div class="row white" id="edit-form">
                <form method="post" class="col s12">
                    <h1>Edit Profile Information</h1>
                    <div class="input-field col s6">
                        <input type="text" id="first" name="firstName" value="<?php echo "$session_first"; ?>" disabled>
                        <label for="first">First Name</label>
                    </div>
                    
                    <div class="input-field col s6">
                        <input type="text" id="last" name="lastName" value="<?php echo "$session_last"; ?>" disabled>
                        <label for="last">Last Name</label>
                    </div>
                    
                    <div class="input-field col s4">
                        <input type="text" id="userN" name="username" value="<?php echo "$session_username"; ?>" disabled>
                        <label for="userN">Username</label>
                    </div>

                    <div class="input-field col s4">
                        <input type="email" id="email" name="email" value="<?php echo "$session_email"; ?>">
                        <label for="email">E-mail</label>
                    </div>
                    
                    <div class="input-field col s4">
                        <input type="text" id="contact" name="mobileNumber" value="<?php echo "$session_contact"; ?>">
                        <label for="contact">Mobile No.</label>
                    </div>
                    
                    <div class="input-field col s12">
                        Password: <a href="changePassword.php"><input type="button" class="btn btn-primary" name="password" value="Change"></a><br><br>
                    </div>
                    
                    <div class="input-field col s12">
                        <input type="date" id="bday" name="birthdate" value="<?php echo "$session_birth"; ?>" disabled>
                        <label for="bday">Birthdate</label>
                    </div>
                    
                    <div class="input-field col s2">
                        <input type="text" id="no" name="addressNo" value="<?php echo "$session_addressNo"; ?>">
                        <label for="no">Address No.</label>
                    </div>
                    
                     <div class="input-field col s2">
                        <input type="text" id="st" name="street"  value="<?php echo "$session_street"; ?>">
                        <label for="st">Street</label>
                    </div>
                
                    <div class="input-field col s3">
                        <input type="text" id="mun" name=" municipality" value="<?php echo "$session_municipality"; ?>">
                        <label for="mun">Municipality</label>
                    </div>
                    
                    <div class="input-field col s3">
                        <input type="text" id="prov" name="province"  value="<?php echo "$session_province"; ?>">
                        <label for="prov">Province</label>
                    </div>
                    
                    <div class="input-field col s2">
                        <input type="text" id="pc" name="postalCode"  value="<?php echo "$session_postal"; ?>">
                        <label for="pc">Postal Code</label>
                    </div><br> 
                    
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                </form>
            </div>
             
        </div>
       <?php include 'modules/footer.php';?>
    </body>
</html>