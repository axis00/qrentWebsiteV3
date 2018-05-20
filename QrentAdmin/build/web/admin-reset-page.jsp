<%@page import="java.sql.SQLException"%>
<%@page import="java.sql.ResultSet"%>
<%@page import="java.sql.PreparedStatement"%>
<%@page import="java.sql.DriverManager"%>
<%@page import="java.sql.Connection"%>
<%@page import="java.time.format.DateTimeFormatter"%>
<%@page import="java.time.LocalDateTime"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">


        <title>Admin Reset Password</title>
    </head>
    <body style="background-color:#f7ebec">
        <div class='container'>
            <%
                if (session.getAttribute("username") == null) {
                    response.sendRedirect("index.jsp");
                }
            %>
            <div class="page-header">
                <h1>Please Set New Password</h1>
            </div>
            <div class="signup-form">
                <form method="post" action="reset-admin-pw.jsp">
                    <div class="form-group">
                        <p>Enter New Password</p>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="repassword" id="repassword" class="form-control" onblur="checkPassword()" placeholder="Re-type password"/><span id="checkPW"></span>
                    </div>
                    <br><br><input class="btn btn-primary btn-lg" type="submit" value="Reset" id="resetButton"/>
                </form>
            </div>
        </div>

        <script>
            function checkPassword(){
                var pw = document.getElementById("password").value;
                var repw = document.getElementById("repassword").value;
                
                if(pw === repw){
                    document.getElementById("checkPW").innerHTML = "OK";
                } else {
                    document.getElementById("checkPW").innerHTML = "Passwords do not match!";
                }
            }
        </script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    </body>
</html>
