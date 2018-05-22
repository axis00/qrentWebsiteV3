
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js" type="text/javascript"></script>
        <link rel="icon" href="qrent-logo.png">
        <title>Register New Admin Account</title>
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
                    <h1>Change Password</h1>
                </div>

            </div>
            <% if (session.getAttribute("username").equals("super")) {%>
            <%@include file="supernav.html"%>
            <%} else {%>
            <%@include file="nav.html"%>
            <%}%>
            
            <div class="signup-form">
                
                <form method="POST" class="form" action="all-change-pw.jsp" >
                    <p>Change your password</p>
                    <div class="form-group">
                        <input type="text" name="username" id="username" class="form-control" value='<% out.println(session.getAttribute("username").toString()); %>' readonly=""/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="oldpassword" id="oldPW" class="form-control" placeholder="Current Password" onkeyup="checkOldPW()" onchange="checkAll()" required/><span id="oldPWSpan"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="newpassword" id="password" class="form-control" placeholder="New Password" onkeyup="checkPassword()" onchange="checkAll()" required/><span id="pwSpan"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="repassword" id="repassword" class="form-control" onkeyup="checkPassword()" placeholder="Re-type New Password" onchange="checkAll()" required/><span id="checkSpan"></span>
                    </div>
                    <br><br><input class="btn btn-primary btn-lg" type="submit" value="Change" id="registerButton"/>
                </form>
            </div>
        </div>

        <script>
            $('#registerButton').prop('disabled', true);
            
            function checkOldPW() {
                var xmlhttp;
                var username = document.getElementById("username").value;
                var oldPW = document.getElementById("oldPW").value;
                var urls = "checkPW.jsp?username=" + username + "&oldPW=" + oldPW;

                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (oldPW == "") {
                        document.getElementById("oldPWSpan").innerHTML = "Please enter your current password.";
                    } else if (xmlhttp.readyState == 4) {
                        document.getElementById("oldPWSpan").innerHTML = "";
                        document.getElementById("oldPWSpan").innerHTML = xmlhttp.responseText;
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

            function validatePW() {
                var pw = document.getElementById("password").value;

                if (pw != "") {
                    document.getElementById("pwSpan").innerHTML = "";
                    return true;
                } else {
                    document.getElementById("pwSpan").innerHTML = "Please enter a password.";
                }
            }
            
            function validateOldPW() {
                if ($('#oldPWSpan').text().trim() == "OK"){
                    return true;
                }
            }

            function validateRePW() {
                if ($('#checkSpan').text() == "OK") {
                    return true;
                }
            }

            $('#checkSpan').on('DOMSubtreeModified', function () {
                checkAll();
            });
            
            $('#oldPWSpan').on('DOMSubtreeModified', function () {
                checkAll();
            });

            function checkAll() {
                if (validatePW() == true && validateRePW() == true && validateOldPW() == true) {
                    $('#registerButton').prop('disabled', false);
                }
            }


        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <%@include file="footer.html"%>
    </body>
</html>
