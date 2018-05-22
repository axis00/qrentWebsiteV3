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
                PreparedStatement ps = con.prepareStatement("UPDATE users SET status='approved' WHERE username=?");
                ps.setString(1, username);

                ps.executeUpdate();
                 ps = con.prepareStatement("SELECT email, firstname FROM users WHERE username =?");
                ps.setString(1, username);
                ResultSet res = ps.executeQuery();
                while (res.next()) {
                    String email = res.getString("email");
                    String name = res.getString("firstname");
                    String message ="We%20have%20reactivated%20your%20Qrent%20account.%20%0D%0A%0D%0AQrent%20Admin%20Team";
                    if (session.getAttribute("username") == null) {
                        response.sendRedirect("index.jsp");
                    } else {
                        
                        out.println("<script>swal('Successful!', 'You have rejected the user account of " + username + "', 'success');</script>");
                        out.println("<script>setTimeout(\"window.location.href = 'manage-users.jsp';\",1800);</script>");
                        out.println("<script>window.location.href = 'mailto:" + email + "?subject=Qrent%20Account%20Confirmation&body=Hi%20"+ name +"%20!%0D%0A%0D%0A" + message + "'</script>");
                    }
                }
            } catch (SQLException ex) {
                out.println(ex);
            }
        %>
        
        
        
    </body>
</html>
