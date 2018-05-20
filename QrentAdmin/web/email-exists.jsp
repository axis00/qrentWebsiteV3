<%-- 
    Document   : RegisterAdmin
    Created on : May 5, 2018, 12:29:23 PM
    Author     : Rammaria Advincula
--%>
<%@page import="java.time.LocalDateTime"%>
<%@page import="java.time.format.DateTimeFormatter"%>
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
        <script src="//code.jquery.com/jquery-1.10.2.js" type="text/javascript"></script>
        <title>Register New Admin User</title>
    </head>
    <body>
        <%
            if (session.getAttribute("username") == null) {
                response.sendRedirect("index.jsp");
            }
        %>
        <%
            
            
            Connection con;
            try {
                DateTimeFormatter formatter = DateTimeFormatter.ofPattern("yyyy-MM-dd");
                
                Class.forName("com.mysql.jdbc.Driver");
                con = DriverManager.getConnection("jdbc:mysql://qrentdb.cqmw41ox1som.ap-southeast-1.rds.amazonaws.com/qrent", "root", "letmein12#");
         
                response.setContentType("text/html");

                String email = request.getParameter("email");
                
                PreparedStatement validate = con.prepareStatement("SELECT email FROM users where email=?");
                validate.setString(1,email);
                ResultSet val = validate.executeQuery();
                
                
                if(val.next()){
                    out.println("<font color=red>");
                    out.println("Email taken.");
                    out.println("</font>");
                } else {
                    out.println("OK");
                }
                
            } catch (SQLException ex) {
                out.println(ex);
            }
        %>
    </body>
</html>
