
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
                <form method="post" class="form" action="register.jsp">
                    <div class="form-group">
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" onblur="checkUsername()"/><span id="usernameExists"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="repassword" id="repassword" class="form-control" onblur="checkPassword()" placeholder="Re-type password"/><span id="checkPW"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" />
                    </div>
                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control" onblur="checkEmail()" placeholder="Email"/><span id="emailExists"></span>
                    </div>
                    <br><br><input class="btn btn-primary btn-lg" type="submit" value="Register" id="registerButton"/>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                $('#registerButton').prop('disabled', true);
            });
            
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
                    if (xmlhttp.readyState == 4) {
                        document.getElementById("usernameExists").innerHTML = "";
                        document.getElementById("usernameExists").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", urls, true);
                xmlhttp.send();
            }

            function checkPassword() {
                var pw = document.getElementById("password").value;
                var repw = document.getElementById("repassword").value;

                if (pw === repw) {
                    document.getElementById("checkPW").innerHTML = "OK";
                } else {
                    document.getElementById("checkPW").innerHTML = "Passwords do not match!";
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
                    if (xmlhttp.readyState == 4) {
                        document.getElementById("emailExists").innerHTML = "";
                        document.getElementById("emailExists").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", urls, true);
                xmlhttp.send();
                
            }
            
            $('#usernameExists').on('DOMSubtreeModified', function (){
                if (($('#usernameExists').text().trim() == "OK") && ($('#checkPW').text() == "OK") && ($('#emailExists').text().trim() == "OK")) {
                    $('#registerButton').prop('disabled', false);
                    console.log("called");
                }
            });
            
            $('#checkPW').on('DOMSubtreeModified', function (){
                if (($('#usernameExists').text().trim() == "OK") && ($('#checkPW').text() == "OK") && ($('#emailExists').text().trim() == "OK")) {
                    $('#registerButton').prop('disabled', false);
                    console.log("called");
                }
            });
            
            $('#emailExists').on('DOMSubtreeModified', function (){
                if (($('#usernameExists').text().trim() == "OK") && ($('#checkPW').text() == "OK") && ($('#emailExists').text().trim() == "OK")) {
                    $('#registerButton').prop('disabled', false);
                }
            });

        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


    </body>
</html>
