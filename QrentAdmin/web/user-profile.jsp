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

            
            <table class="bootstrap-table table table-striped table-no-bordered" data-toggle="table">
                <thead>
                    <tr>
                        <th scope="col" data-field="username" data-sortable="true">Username</th>
                        <th scope="col" data-field="firstname" data-sortable="true">First Name</th>
                        <th scope="col" data-field="lastname" data-sortable="true">Last Name</th>
                        <th scope="col" data-field="email" data-sortable="true">Email</th>
                        <th scope="col" data-field="status" data-sortable="true">Status</th>
                        <th scope="col" >Action</th>
                        <th scope="col" data-field="type" data-sortable="true">Type</th>
                    </tr>
                </thead>
                <%
                    Connection con;
                    try {
                        Class.forName("com.mysql.jdbc.Driver");
                        con = DriverManager.getConnection("jdbc:mysql://qrentdb.cqmw41ox1som.ap-southeast-1.rds.amazonaws.com/qrent", "root", "letmein12#");

                        response.setContentType("text/html");
                        String username = request.getParameter("username");
                         PreparedStatement ps = con.prepareStatement("SELECT username, firstname, lastname, email, type, status FROM users NATURAL JOIN customers WHERE username = ?");
                         ps.setString(1, username);
                        ResultSet res = ps.executeQuery();
                        out.println(username);
                        out.println("<tbody id='users'>");
                        while (res.next()) {
                            
                            out.println("<tr scope='row' classtablecontent='row-hover'>");
                            out.println("<td><form action='user-profile.jsp' method='GET' target='_blank'><input class='btn btn-link' type='submit' value='" + res.getString("username") + "'/></form></td>");
                            out.println("<td>" + res.getString("firstname") + "</td>");
                            out.println("<td>" + res.getString("lastname") + "</td>");
                            out.println("<td>" + res.getString("email") + "</td>");
                            if(res.getString("status").equals("rejected")){
                              out.println("<td><span class=\"badge badge-danger\">" + res.getString("status").toUpperCase() + "</span></td>");  
                              out.println("<td></td>");
                            }else if(res.getString("status").equals("approved")){
                              out.println("<td><span class=\"badge badge-success\">ENABLED</span></td>");
                              out.println("<td><form action = 'remove-user.jsp' method = 'POST'><input type = 'hidden' name = 'username' value = "
                                    + res.getString("username") + "><input type = 'submit' value = 'DISABLE' class='btn btn-danger btn-sm'></form></td>");
                            }else{
                              out.println("<td><span class=\"badge badge-secondary\">" + res.getString("status").toUpperCase() + "</span></td>"); 
                              out.println("<td><form action = 'reactivate-user.jsp' method = 'POST'><input type = 'hidden' name = 'username' value = "
                                    + res.getString("username") + "><input type = 'submit' value = 'ENABLE' class='btn btn-success btn-sm'></form></td>");
                            }
                            out.println("<td>" + res.getString("type") + "</td>");
                            out.println("</tr>");
                        }
                         out.println("</tbody>");
                    } catch (SQLException ex) {
                        out.println(ex);
                    }
                %>
            </table>

        </div>
    </body>
</html>
