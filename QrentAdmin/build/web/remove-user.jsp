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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link rel="icon" href="qrent-logo.png">
        <title>Disable User Account</title>
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
                PreparedStatement ps = con.prepareStatement("UPDATE users SET status='disabled' WHERE username=?");
                ps.setString(1, username);

                ps.executeUpdate();
                
                out.println("<script>swal('Successful!', 'You have disabled the user account of " + username + "', 'success');</script>");
                out.println("<script>setTimeout(\"window.location.href = 'manage-users.jsp';\",1800);</script>");
            } catch (SQLException ex) {
                out.println(ex);
            }
        %>
        
        
        
    </body>
</html>
