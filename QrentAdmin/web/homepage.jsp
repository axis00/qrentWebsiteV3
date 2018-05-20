<%@page import="java.time.format.DateTimeFormatter"%>
<%@page import="java.time.LocalDateTime"%>
<%@page import="java.sql.DriverManager"%>
<%@page import="java.sql.Connection"%>
<%@page import="java.sql.SQLException"%>
<%@page import="java.sql.PreparedStatement"%>
<%@page import="java.sql.ResultSet"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <title>Homepage</title>
    </head>
    <body id="body">
        <div class="container">
            <%
                if (session.getAttribute("username") == null) {
                    response.sendRedirect("index.jsp");
                }
            %>
            <div class="row hidden-xs topper" id="top-nav-container">
                <div class="cols-xs-7 col-sm-7">
                    <a href="homepage.jsp"><img src="qrent-logo.png" id="nav-logo" class="img-responsive"/></a>
                </div>
                <div class="cols-xs-5 col-xs-offset-1 col-sm-offset-0 text-left" id="page-header">
                    <h1>Admin Homepage</h1>
                </div>
            </div>

           <% if(session.getAttribute("username").equals("super")) {%>
           <%@include file="supernav.html"%>
           <%}else{%>
           <%@include file="nav.html"%>
           <%}%>

            <div class="pricing-header">

                <h1 class="display-4">Welcome <b><%out.println(session.getAttribute("username"));%></b>!</h1>

            </div>
            <br><br>
            <div class="card-deck">

                <div class="card bg-info mb-3" style="max-width: 18rem;">
                    <div class="card-header">Administration</div>
                    <div class="card-body">
                        <h5 class="card-title">Reminder</h5>
                        <p class="card-text">Regularly check pending user accounts by clicking on <a href="approve-accounts.jsp" class="text-white">Approve User Accounts</a>.</p>    
                    </div>
                </div>
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Statistics</div>
                    <div class="card-body">
                        <h5 class="card-title">User Count</h5>
                        <%
                            Connection con;
                            try {

                                Class.forName("com.mysql.jdbc.Driver");
                                con = DriverManager.getConnection("jdbc:mysql://qrentdb.cqmw41ox1som.ap-southeast-1.rds.amazonaws.com/qrent", "root", "letmein12#");

                                response.setContentType("text/html");

                                PreparedStatement ps = con.prepareStatement("SELECT COUNT(username) FROM users WHERE status = 'pending'");

                                ResultSet res = ps.executeQuery();

                                if (!res.next()) {
                                    out.println("<p class=\"card-text\">No Users Available</p>");
                                } else {
                                    res.previous();
                                    while (res.next()) {
                                        out.println("<p class=\"card-text\">There are <b>" + res.getString("COUNT(username)") + "</b> pending users in Qrent.</p>");

                                    }
                                }
                            } catch (SQLException ex) {
                                out.println(ex);
                            }
                        %>
                    </div>

                </div>
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Statistics</div>
                    <div class="card-body">
                        <h5 class="card-title">User Count</h5>
                        <%
                            try {

                                Class.forName("com.mysql.jdbc.Driver");
                                con = DriverManager.getConnection("jdbc:mysql://qrentdb.cqmw41ox1som.ap-southeast-1.rds.amazonaws.com/qrent", "root", "letmein12#");

                                response.setContentType("text/html");

                                PreparedStatement ps = con.prepareStatement("SELECT COUNT(username) FROM users WHERE status = 'approved'");

                                ResultSet res = ps.executeQuery();

                                if (!res.next()) {
                                    out.println("<p class=\"card-text\">No Users Available</p>");
                                } else {
                                    res.previous();
                                    while (res.next()) {
                                        out.println("<p class=\"card-text\">There are <b>" + res.getString("COUNT(username)") + "</b> active users in Qrent.</p>");

                                    }
                                }
                            } catch (SQLException ex) {
                                out.println(ex);
                            }
                        %>
                    </div>               
                </div>

                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Statistics</div>
                    <div class="card-body">
                        <h5 class="card-title">Transaction Count</h5>
                        <%
                            try {
                                Class.forName("com.mysql.jdbc.Driver");
                                con = DriverManager.getConnection("jdbc:mysql://qrentdb.cqmw41ox1som.ap-southeast-1.rds.amazonaws.com/qrent", "root", "letmein12#");

                                response.setContentType("text/html");

                                PreparedStatement ps = con.prepareStatement("SELECT COUNT(paymentID) FROM transaction");

                                ResultSet res = ps.executeQuery();

                                if (!res.next()) {
                                    out.println("<p class=\"card-text\">No Transaction Available</p>");
                                } else {
                                    res.previous();
                                    while (res.next()) {
                                        out.println("<p class=\"card-text\">There is/are <b>" + res.getString("COUNT(paymentID)") + "</b> transaction/s in Qrent.</p>");

                                    }
                                }
                            } catch (SQLException ex) {
                                out.println(ex);
                            }
                        %>
                    </div>
                </div>
            </div>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    </body>
</html>
