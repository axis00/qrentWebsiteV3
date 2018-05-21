
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js" type="text/javascript"></script>
        <title>Register New Admin User</title>
    </head>
    <body style="background-color:#f7ebec">
        <%
            if (session.getAttribute("username") == null) {
                response.sendRedirect("index.jsp");
            }
        %>

        <div class='container'>
            <div class="row hidden-xs topper" id="top-nav-container">
                <div class="cols-xs-7 col-sm-7">
                    <img src="qrent-logo.png" id="nav-logo" class="img-responsive"/>
                </div>
                <div class="cols-xs-5 col-xs-offset-1 col-sm-offset-0 text-left" id="page-header">
                    <h1>Register Admin</h1>
                </div>

            </div>
            <%@include file="supernav.html"%>
            <div class="signup-form">
                <p>Create a new administrator account. Fill up all the input fields.</p>
                <form method="post" class="form" action="register.jsp" >
                    <div class="form-group">
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" onblur="checkUsername()" onchange="checkAll()" required/><span id="usernameSpan"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" onblur="validatePW()" onchange="checkAll()" required/><span id="pwSpan"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="repassword" id="repassword" class="form-control" onkeyup="checkPassword()" placeholder="Re-type password" onchange="checkAll()" required/><span id="checkSpan"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" onblur="validateFirstN()" onchange="checkAll()" required/><span id="firstSpan"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" onblur="validateLastN()" onchange="checkAll()" required/><span id="lastSpan"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control" onblur="checkEmail()" placeholder="Email" onchange="checkAll()" required/><span id="emailSpan"></span>
                    </div>
                    <br><br><input class="btn btn-primary btn-lg" type="submit" value="Register" id="registerButton"/>
                </form>
            </div>
        </div>

        <script>
            $('#registerButton').prop('disabled', true);

            function checkUsername() {
                var xmlhttp;
                var username = document.getElementById("username").value;
                var urls = "username-exists.jsp?username=" + username;

                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (username == "") {
                        document.getElementById("usernameSpan").innerHTML = "Please enter a username.";
                    } else if (xmlhttp.readyState == 4) {
                        document.getElementById("usernameSpan").innerHTML = "";
                        document.getElementById("usernameSpan").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", urls, true);
                xmlhttp.send();
            }

            function checkPassword() {
                var pw = document.getElementById("password").value;
                var repw = document.getElementById("repassword").value;

                if (pw == "") {
                    document.getElementById("checkSpan").innerHTML = "";
                } else if (pw === repw) {
                    document.getElementById("checkSpan").innerHTML = "OK";
                } else {
                    document.getElementById("checkSpan").innerHTML = "Passwords do not match!";
                }
            }

            function checkEmail() {
                var xmlhttp;
                var email = document.getElementById("email").value;
                var urls = "email-exists.jsp?email=" + email;

                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (email == "") {
                        document.getElementById("emailSpan").innerHTML = "Please enter an email address.";
                    } else if (xmlhttp.readyState == 4) {
                        document.getElementById("emailSpan").innerHTML = "";
                        document.getElementById("emailSpan").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", urls, true);
                xmlhttp.send();

            }

            function validateUsername() {
                if ($('#usernameSpan').text().trim() == "OK") {
                    return true;
                }
            }

            function validatePW() {
                var pw = document.getElementById("password").value;

                if (pw != "") {
                    document.getElementById("pwSpan").innerHTML = "";
                    return true;
                } else {
                    document.getElementById("pwSpan").innerHTML = "Please enter a password.";
                }
            }

            function validateRePW() {
                if ($('#checkSpan').text() == "OK") {
                    return true;
                }
            }

            function validateFirstN() {
                var firstN = document.getElementById("firstname").value;

                if (firstN != "") {
                    document.getElementById("firstSpan").innerHTML = "";
                    return true;
                } else {
                    document.getElementById("firstSpan").innerHTML = "Please enter the first name.";
                }
            }

            function validateLastN() {
                var lastN = document.getElementById("lastname").value;

                if (lastN != "") {
                    document.getElementById("lastSpan").innerHTML = "";
                    return true;
                } else {
                    document.getElementById("lastSpan").innerHTML = "Please enter the last name.";
                }
            }

            function validateEmail() {
                if ($('#emailSpan').text().trim() == "OK") {
                    return true;
                }
            }

            $('#usernameSpan').on('DOMSubtreeModified', function () {
                checkAll();
            });

            $('#emailSpan').on('DOMSubtreeModified', function () {
                checkAll();
            });

            $('#checkSpan').on('DOMSubtreeModified', function () {
                checkAll();
            });

            function checkAll() {
                console.log("called");
                if (validateUsername() == true && validatePW() == true && validateRePW() == true && validateFirstN() == true && validateLastN() == true && validateEmail() == true) {
                    $('#registerButton').prop('disabled', false);
                }
            }


        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    </body>
</html>
