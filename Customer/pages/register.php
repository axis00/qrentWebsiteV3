<script>
    function passwordValidationF()
    {
        alert("Password does not match");
        window.location.href = "http://laboratory/pages/register.php";
    }
    function usernameValidate()
    {
        alert("Username already exists");
        window.location.href = "http://laboratory/pages/register.php";
    }
    function emailValidate()
    {
        alert("Email already exists");
        window.location.href = "http://laboratory/pages/register.php";      
    }
    
    function successfull()
    {
        alert("Registration Success!");
        window.location.href = "http://laboratory/pages/home";
    }
    function allFields()
    {
        alert("All fields must be filled");
    }
</script>

<?php
        
        require "../util/connectToDb.php";
        session_start();
        if( isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['birthday']) && isset($_POST['email']) && isset($_POST['mobileNumber']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['verifyPassword']) && isset($_POST['addressNo']) && isset($_POST['street']) && isset($_POST['municipality']) && isset($_POST['province']) && isset($_POST['postalCode'])){
            $first = $_POST['firstName'];
            $last = $_POST['lastName'];
            $birthday = $_POST['birthday'];
            $email = $_POST['email'];
            $mobile = $_POST['mobileNumber'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $verifyPassword = $_POST['verifyPassword'];
            $addressNo = $_POST['addressNo'];
            $street = $_POST['street'];
            $municipality = $_POST['municipality'];
            $province = $_POST['province'];
            $postalCode = $_POST['postalCode'];
            $registration_date = date("Y/m/d");
            $type = "Client";
            $addressType = "Home";
            $status = "pending";
            
            $query = "SELECT email FROM users where email = '$email '";
            $results = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($results, MYSQLI_ASSOC); 
            $count = mysqli_num_rows($results);

            if($first == null || $last == null || $birthday == null || $email == null || $mobile == null || $username == null || $password == null || $verifyPassword == null || $addressNo == null || $street == null || $municipality == null || $province == null || $postalCode == null){
                    echo "<script> allFields() </script>";
            }else{
                $query2 = "SELECT username FROM users where username = '$username'";
                $results2 = mysqli_query($conn, $query2);
                $row2 = mysqli_fetch_array($results2, MYSQLI_ASSOC); 
                $count2 = mysqli_num_rows($results2);
            
                if($count2 == 1){
                    echo "<script>usernameValidate()</script>";
                    }else{
                        if($count == 1){
                            echo "<script>emailValidate()</script>";
                            }else{
                                $password = password_hash($password, PASSWORD_DEFAULT); 
                                $stmt = $conn->prepare("INSERT INTO users(username, password, type, firstname, lastname, email, status, registrationdate) VALUES(?,?,?,?,?,?,?,NOW())");
                                $stmt->bind_param("sssssss", $username, $password, $type, $first, $last, $email, $status);

                                $stmt2 = $conn->prepare("INSERT INTO customers(username, contactno, birthdate, addressno, street, municipality, province, postalcode) VALUES(?,?,?,?,?,?,?,?)");
                                $stmt2->bind_param("ssssssss", $username, $mobile, $birthday, $addressNo, $street, $municipality, $province, $postalCode);
                    
                                if(!$stmt->execute()){
                                    echo $stmt->error;
                                    }elseif (!$stmt2->execute()){
                                        echo $stmt2->error;
                                        }else{
                                            $_SESSION['user'] = $username;
                                            echo "<script>successfull()</script>";
                                        }
                                }
                        }
                }
        }
    ?>

<!DOCTYPE HTML>
<html>
    
    <head>
        <!--CSS-->
        <link rel="stylesheet" href="../styles/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Qrent</title>
    </head>
    
    <body>
        <div class="valign-wrapper center-align">
            <div class="row white" id="registration-form">                  
                <form method="post" class="col s12">
                    <h1>Registration</h1>
                    <div class="input-field col s6">
                        <input type="text"  id="first" name="firstName" placeholder="First Name">
                        <label for="first">First Name</label>
                    </div>
                    
                    <div class="input-field col s6">
                        <input type="text" id="last" name="lastName" placeholder="Last Name">
                        <label for="last">Last Name</label>
                    </div>
                    
                    <div class="input-field col s4">
                        <input type="text"  id="user" name="username" placeholder="Username">
                        <label for="user">Username</label>
                    </div>
                    
                    <div class="input-field col s4">
                        <input type="email"  id="email" name="email" placeholder="E-mail Address">
                        <label for="email">E-mail Address</label>
                    </div>
                    
                    <div class="input-field col s4">
                        <input type="text" id="phone" name="mobileNumber" placeholder="Mobile Number">
                        <label for="phone">Contact No.</label>
                    </div>
            
                    <div class="input-field col s6">
                        <input type="password" id="pass" name="password" placeholder="Password">
                        <label for="pass">Password</label>
                    </div>
                    
                    <div class="input-field col s6">
                        <input type="password" id="rePass" name="verifyPassword" placeholder="Re-enter Password">
                        <label for="rePass">Re-type Password</label>
                    </div>
            
                    <div class="input-field col s12">
                        <input type="date" id="bdate" name="birthday">
                        <label for="bdate">Birthdate</label>
                    </div>
                    
                    <p class="center-align">Address</p>
                    
                    <div class="input-field col s2">
                        <input type="text" id="no" name="addressNo" placeholder="Address Number">
                        <label for="no">Address No.</label>
                    </div>    
                    
                    <div class="input-field col s2">    
                        <input type="text" id="st" name="street" placeholder="Street">
                        <label for="st">Street</label>
                    </div>    
                    
                    <div class="input-field col s3">
                        <input type="text" id="mun" name=" municipality" placeholder="Municipality">
                        <label for="mun">Municipality</label>
                    </div>    
                    
                    <div class="input-field col s3">   
                        <input type="text" id="prov" name="province" placeholder="Province">
                        <label for="prov">Province</label>
                    </div>    
                    
                    <div class="input-field col s2">        
                        <input type="text" id="pc" name="postalCode" placeholder="Postal Code">
                         <label for="pc">Postal Code</label>
                    </div>    
                    
                    <input type="submit" class="btn" value="Register">
                <p>Already have an account? <a href="../pages/login.php">Login here.</a></p>
                </form>
            </div>        
        </div>
    </body>
</html>