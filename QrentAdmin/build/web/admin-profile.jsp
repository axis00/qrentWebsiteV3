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
        <title>User Profile</title>
        <link rel="icon" href="qrent-logo.png">
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
                    <h1>User Profile</h1>
                </div>
            </div>

            <% if (session.getAttribute("username").equals("super")) {%>
            <%@include file="supernav.html"%>
            <%} else {%>
            <%@include file="nav.html"%>
            <%}%>

            <%
                Connection con;
                try {
                    Class.forName("com.mysql.jdbc.Driver");
                    con = DriverManager.getConnection("jdbc:mysql://qrentdb.cqmw41ox1som.ap-southeast-1.rds.amazonaws.com/qrent", "root", "letmein12#");

                    response.setContentType("text/html");
                    String username = request.getParameter("username");
                    PreparedStatement ps = con.prepareStatement("SELECT *, COUNT(itemno) FROM users INNER JOIN Item ON Item.itemOwner=users.username WHERE username = ?");
                    ps.setString(1, username);
                    ResultSet res = ps.executeQuery();

                    while (res.next()) {

                        out.println("<div class='card' style='width:inherit' id='profile-card'>");

                        out.println("<div class='card-body'>");
                        out.println("<h1 class='card-title'>" + res.getString("username") + "</h1>");
                        out.println("<h4 class='card-subtitle mb-2 text-muted'>" + res.getString("type") + "</h4>");
                        out.println("<div class='card-text'>");
                        out.println("<table class='table table-borderless'");
                        out.println("<tbody>");
                        out.println("<tr>");
                        out.println("<th scope='row'>Name:</th>");
                        out.println("<td>" + res.getString("firstname") + " " + res.getString("lastname") + "</td>");
                        out.println("</tr>");
                        out.println("<tr>");
                        out.println("<th scope='row'>Email:</th>");
                        out.println("<td>" + res.getString("email") + "</td>");
                        out.println("</tr>");
                        out.println("<tr>");
                        out.println("<th scope='row'>Registration Date:</th>");
                        out.println("<td>" + res.getString("registrationdate") + "</td>");
                        out.println("</tr>");
                         out.println("<tr>");
                        out.println("<th scope='row'>Items posted:</th>");
                        out.println("<th>" + res.getString("COUNT(itemno)") + "</th>");
                        out.println("</tr>");
                        
                        out.println("</tbody>");
                        out.println("</table>");
                        out.println("</div>");

                    }
                    
                    PreparedStatement trans = con.prepareStatement("SELECT * FROM users INNER JOIN Item ON Item.itemOwner=users.username WHERE username = ?");

                   
                    trans.setString(1, username);
                    ResultSet rs = trans.executeQuery();
                    
                    out.println("<div>");
                        out.println("<table class='bootstrap-table table table-no-bordered' data-toggle='table' id='users'>");
                        out.println("<thead id='profile-tran-thead'>");
                        out.println("<tr>");
                        out.println("<th scope='col' data-field='itemnum' data-sortable='true'>Item No.</th>");
                        out.println("<th scope='col' data-field='item' data-sortable='true'>Item Name</th>");
                        out.println("<th scope='col' data-field='price' data-sortable='true'>Rent Price</th>");
                        out.println("<th scope='col' data-field='orig' data-sortable='true'>Original Price</th>");
                        out.println("<th scope='col' data-field='cond' data-sortable='true'>Item Condition</th>");
                        out.println("<th scope='col' data-field='desc' data-sortable='true'>Item Desc.</th>");
                        
                        out.println("<th></th>");
                        out.println("</tr>");
                        out.println("</thead>");
                    while (rs.next()) {
                        
                        out.println("<tbody id='profile-tran-tbody'>");
                        out.println("<tr scope='row' class='row-hover'>");
                        out.println("<td>" + rs.getString("itemno") + "</td>");
                        out.println("<td>" + rs.getString("itemName") + "</td>");
                        out.println("<td>" + rs.getString("itemRentPrice") + "</td>");
                        out.println("<td>" + rs.getString("itemOrigPrice") + "</td>");
                        out.println("<td>" + rs.getString("itemCondition") + "</td>");
                        out.println("<td>" + rs.getString("itemDescription") + "</td>");
                        out.println("</tr>");
                        
                    }
                    
                    out.println("</tbody>");
                        out.println("</table>");
                        out.println("</div>");
                        out.println("</div>");

                } catch (SQLException ex) {
                    out.println(ex);
                }
            %>

        </div>
        <%@include file="footer.html"%>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    </body>
</html>
