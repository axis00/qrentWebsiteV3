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
        <script>
            function searchword() {
                var input, search, table, tr, td, i;
                input = document.getElementById("keyword");
                search = input.value.toUpperCase();
                table = document.getElementById("transaction");
                tr = table.getElementsByTagName("tr");

                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
                    if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(search) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>
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
                    <h1>Manage Users</h1>
                </div>
            </div>

            <% if (session.getAttribute("username").equals("super")) {%>
            <%@include file="supernav.html"%>
            <%} else {%>
            <%@include file="nav.html"%>
            <%}%>
            <input type="text" id="keyword" onkeyup="searchword()" placeholder="Search transaction no..." class="search search-control">
            <table class="bootstrap-table table table-no-bordered" data-toggle="table" id="users">
                <thead>
                    <tr>
                        <th scope="col" data-field="date" data-sortable="true">Trans. Date</th>
                        <th scope="col" data-field="num" data-sortable="true">Trans. No.</th>
                        <th scope="col" data-field="username" data-sortable="true">Client</th>
                        <th scope="col" data-field="item" data-sortable="true">Item Name</th>
                        <th scope="col" data-field="itemnum" data-sortable="true">Item No.</th>
                        <th scope="col" data-field="days" data-sortable="true">Rent Duration</th>
                        <th scope="col" data-field="price" data-sortable="true">Rent Price</th>
                        <th scope="col" data-field="payment" data-sortable="true">Mode of Payment</th>
                        <th></th>
                    </tr>
                </thead>
                <%
                    Connection con;
                    try {
                        Class.forName("com.mysql.jdbc.Driver");
                        con = DriverManager.getConnection("jdbc:mysql://qrentdb.cqmw41ox1som.ap-southeast-1.rds.amazonaws.com/qrent", "root", "letmein12#");

                        response.setContentType("text/html");

                        PreparedStatement ps = con.prepareStatement("SELECT paymentdate, paymentid, username, itemName,"
                                + " Reservation.itemno, itemRentPrice, paymentType, duration FROM "
                                + "(((transaction INNER JOIN Reservation ON transaction.reservation = Reservation.ReservationID) "
                                + "INNER JOIN customers ON customers.username = Reservation.client) INNER JOIN Item ON"
                                + " Item.itemno = Reservation.itemno)ORDER BY paymentdate ASC");

                        ResultSet res = ps.executeQuery();

                        if (!res.next()) {
                            out.println("<tr><td> There are no transactions available </td></tr>");
                        } else {
                            res.previous();
                            while (res.next()) {
                                out.println("<tr scope='row' class='row-hover'>");
                                out.println("<td>" + res.getString("paymentdate") + "</td>");
                                out.println("<td>" + res.getString("paymentid") + "</td>");
                                out.println("<td>" + res.getString("username") + "</td>");
                                out.println("<td>" + res.getString("itemName") + "</td>");
                                out.println("<td>" + res.getString("itemno") + "</td>");
                                out.println("<td>" + res.getString("duration") + "</td>");
                                out.println("<td>" + res.getString("itemRentPrice") + "</td>");
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

    </body>
</html>
    