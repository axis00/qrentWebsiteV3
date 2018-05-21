
<%@page import="java.security.MessageDigest"%>
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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link rel="icon" href="qrent-logo.png">
        <title>Reset Admin Password</title>
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
                try {
                    String username = session.getAttribute("username").toString();
                    String password = request.getParameter("password");

                    MessageDigest mdAlgorithm = MessageDigest.getInstance("MD5");
                    mdAlgorithm.update(password.getBytes());
                    byte[] digest = mdAlgorithm.digest();
                    StringBuffer hex = new StringBuffer();

                    for (int i = 0; i < digest.length; i++) {
                        password = Integer.toHexString(0xFF & digest[i]);

                        if (password.length() < 2) {
                            password = "0" + password;
                        }

                        hex.append(password);
                    }
                    password = hex.toString();

                    PreparedStatement ps = con.prepareStatement("UPDATE users SET password=? WHERE username=?");
                    ps.setString(1, password);
                    ps.setString(2, username);

                    ps.execute();

                    out.println("<script>swal('Successful!', 'You have successfully reset your password!', 'success');</script>");
                        out.println("<script>setTimeout(\"window.location.href ='homepage.jsp';\",1800);</script>");
                    
                } catch (SQLException ex) {
                    out.println(ex);
                }
            } catch (SQLException ex) {
                out.println(ex);
            }
        %>

    </body>
</html>
