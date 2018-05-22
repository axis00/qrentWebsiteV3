<%-- 
    Document   : user-transactions
    Created on : 05 9, 18, 3:00:13 PM
    Author     : Advincula, Rammaria
--%>
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
        <title>Transaction History</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://rawgit.com/wenzhixin/bootstrap-table/master/src/bootstrap-table.js"></script>
        <link rel="stylesheet" type="text/css" href="https://rawgit.com/wenzhixin/bootstrap-table/master/src/bootstrap-table.css">
        <link rel="icon" href="qrent-logo.png">
    </head>
    <body id="body">
        <%
            if (session.getAttribute("username") == null) {
                response.sendRedirect("index.jsp");
            }
        %>
        <div class="container">
            <div class="row hidden-xs topper" id="top-nav-container">
                <div class="cols-xs-7 col-sm-7">
                    <img src="qrent-logo.png" id="nav-logo" class="img-responsive"/>
                </div>
                <div class="cols-xs-5 col-xs-offset-1 col-sm-offset-0 text-left" id="page-header">
                    <h1>Transaction History</h1>
                </div>
            </div>

            <% if (session.getAttribute("username").equals("super")) {%>
            <%@include file="supernav.html"%>
            <%} else {%>
            <%@include file="nav.html"%>
            <%}%>
            <br>
            
            <div class="row">
                <div class="col-sm-4">
                    <input class="form-control form-control-sm" id="keyword" type="text" placeholder="Search username, first name, last name, email, etc..." width="100%"/>
                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-1">
                   View: 
                </div>
                <div class="col-sm-3">
                    <select class="form-control form-control-sm" id="options" onchange="changepage()">
                        <option value="1" hidden>Choose transaction date here</option>
                        <option value="1"  >All Transactions</option>
                        <option value="2"selected disable hidden>This Year Transactions</option>
                        <option value="3">This Month Transactions</option>
                    <option value="4">Today Transactions</option>
                    </select>


                        <script>

                            function changepage() {
                                var x = document.getElementById("options").value;
                                if (x == '1') {
                                    window.location.href = 'user-transaction.jsp';
                                } else if (x == '2') {
                                    window.location.href = 'yearly-trans.jsp';
                                } else if (x == '3') {
                                    window.location.href = 'monthly-trans.jsp';
                                } else{
                                    window.location.href = 'today-trans.jsp';
                                }
                            }
                        
                        $(document).ready(function () {
                            $("#keyword").on("keyup", function () {
                                var value = $(this).val().toLowerCase();
                                $("#users tr").filter(function () {
                                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                });
                            });
                        });
                    </script>
                </div>
            </div>
            
            <table class="bootstrap-table table table-no-bordered" data-toggle="table" id="users">
                <thead>
                    <tr>
                        <th scope="col" data-field="date" data-sortable="true">Trans. Date</th>
                        <th scope="col" data-field="num" data-sortable="true">Trans. No.</th>
                        <th scope="col" data-field="username" data-sortable="true">Client</th>
                        <th scope="col" data-field="owner" data-sortable="true">Owner</th>
                        <th scope="col" data-field="item" data-sortable="true">Item Name</th>
                        <th scope="col" data-field="itemnum" data-sortable="true">Item No.</th>
                       <th scope="col" data-field="duration" data-sortable="true">Duration</th>
                            <th scope="col" data-field="price" data-sortable="true">Rent Price</th>
                        <th scope="col" data-field="tota" data-sortable="true">Total Charge</th>
                        <th scope="col" data-field="payment" data-sortable="true">Payment Mode</th>
                        
                    </tr>
                </thead>
                <%
                    Connection con;
                    try {
                        Class.forName("com.mysql.jdbc.Driver");
                        con = DriverManager.getConnection("jdbc:mysql://qrentdb.cqmw41ox1som.ap-southeast-1.rds.amazonaws.com/qrent", "root", "letmein12#");

                        response.setContentType("text/html");

                        PreparedStatement ps = con.prepareStatement("SELECT * FROM "
                                + "(((transaction INNER JOIN Reservation ON transaction.reservation = Reservation.ReservationID) "
                                + "INNER JOIN customers ON customers.username = Reservation.client) INNER JOIN Item ON"
                                + " Item.itemno = Reservation.itemno) WHERE  YEAR(paymentDate) = YEAR(CURDATE())ORDER BY paymentdate ASC");

                        ResultSet res = ps.executeQuery();

                        if (!res.next()) {
                            out.println("<tbody id='users'><tr><td> There are no transactions available </td></tr>");
                        } else {
                            res.previous();
                            while (res.next()) {
                                out.println("<tr scope='row' class='row-hover'>");
                                out.println("<td>" + res.getString("paymentdate") + "</td>");
                                out.println("<td>" + res.getString("paymentid") + "</td>");
                                out.println("<td>" + res.getString("username") + "</td>");
                                out.println("<td>" + res.getString("itemOwner") + "</td>");
                                out.println("<td>" + res.getString("itemName") + "</td>");
                                out.println("<td>" + res.getString("itemno") + "</td>");
                                out.println("<td>" + res.getString("duration") + "</td>");
                                out.println("<td>" + res.getString("itemRentPrice") + "</td>");
                                out.println("<td>" + res.getString("paymentAmount") + "</td>");
                                out.println("<td>" + res.getString("paymentType") + "</td>");
                                out.println("</tr>");
                            }
                        }
                    } catch (SQLException ex) {
                        out.println(ex);
                    }
                %>
                
            </table>
        </div>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <%@include file="footer.html"%>
    </body>
</html>
