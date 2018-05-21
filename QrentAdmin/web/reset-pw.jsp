
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

                String username = request.getParameter("username");

                PreparedStatement validate = con.prepareStatement("SELECT username FROM users WHERE type='admin' AND username=?");
                validate.setString(1, username);
                ResultSet val = validate.executeQuery();

                if (val.next()) {
                    try {
                        String password = "password123";

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
                        
                        out.println("<script>swal('Successful!', 'The password for "+ username +" has been reset!', 'success');</script>");
                        out.println("<script>setTimeout(\"window.location.href ='super-reset-pw.jsp';\",1800);</script>");
                        
                    } catch (SQLException ex) {
                        out.println(ex);
                    }

                } else {
                    out.println("<script>swal('Error!', 'The username "+ username +" does not exist!', 'error');</script>");
                    out.println("<script>setTimeout(\"window.location.href ='super-reset-pw.jsp';\",1800);</script>");
                }
            } catch (SQLException ex) {
                out.println(ex);
            }
        %>

    </body>
</html>
