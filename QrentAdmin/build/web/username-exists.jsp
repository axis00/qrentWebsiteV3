
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
        <link rel="icon" href="qrent-logo.png">
        <title></title>
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
                
                Class.forName("com.mysql.jdbc.Driver");
                con = DriverManager.getConnection("jdbc:mysql://qrentdb.cqmw41ox1som.ap-southeast-1.rds.amazonaws.com/qrent", "root", "letmein12#");
         
                response.setContentType("text/html");

                String username = request.getParameter("username");
                
                PreparedStatement validate = con.prepareStatement("SELECT USERNAME FROM users where username=?");
                validate.setString(1,username);
                ResultSet val = validate.executeQuery();
                
                
                if(val.next()){
                    out.println("<p>");
                    out.println("Username exists.");
                    out.println("</p>");
                } else {
                    out.println("OK");
                }
            } catch (SQLException ex) {
                out.println(ex);
            }
        %>
    </body>
</html>
