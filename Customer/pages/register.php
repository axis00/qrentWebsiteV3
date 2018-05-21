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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Qrent</title>
    </head>
    
    <body>
            <div class="jumbotron">
                <h1>Registration</h1>
            <form action="register.php" method="post">
                <div class="form-group">          
                    <input type="text" class="form-control" name="firstName" placeholder="First Name"><br>
            
                    <input type="text"class="form-control" name="lastName" placeholder="Last Name"><br>
                
                    <input type="text" class="form-control" name="username" placeholder="Username"><br>

                    <input type="email" class="form-control" name="email" placeholder="E-mail Address"><br>
            
                    <input type="text" class="form-control" name="mobileNumber" placeholder="Mobile Number"><br>
            
                    <input type="password" class="form-control" name="password" placeholder="Password"><br>
            
                    <input type="password" class="form-control" name="verifyPassword" placeholder="Re-enter Password"><br>
            
                    <p>Birthday: <br>
                        <input type="date" class="form-control" name="birthday"><br>
                    </p>
                
                    <p>Address: <br>
                        <input type="text" class="form-control" name="addressNo" placeholder="Address Number"> <br>
                        
                        <input type="text" class="form-control" name="street" placeholder="Street"> <br>
                
                        <input type="text" class="form-control" name=" municipality" placeholder="Municipality"> <br>
            
                        <input type="text" class="form-control" name="province" placeholder="Province"> <br>
                            
                        <input type="text" class="form-control" name="postalCode" placeholder="Postal Code"> <br>
                    </p>
                </div>
                
                <div id="button-reg">
                    <input type="submit" class="btn btn-primary" value="Register">
                </div>
                <p>Already have an account? <a href="../pages/login.php">Login here.</a></p>
            </form>
            </div>
    </body>
</html>