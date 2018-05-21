<%@page import="java.security.MessageDigest"%>
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
        <title></title>
    </head>
    <body>
        <%
            Connection con;
            try {
                Class.forName("com.mysql.jdbc.Driver");
                con = DriverManager.getConnection("jdbc:mysql://qrentdb.cqmw41ox1som.ap-southeast-1.rds.amazonaws.com/qrent", "root", "letmein12#");

                response.setContentType("text/html");

                String username = request.getParameter("username");
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
                
                //hashing default pw "resPW"
                String resPW = "password123";
                mdAlgorithm.update(resPW.getBytes());
                byte[] digest2 = mdAlgorithm.digest();
                StringBuffer hex2 = new StringBuffer();
                for (int i = 0; i < digest2.length; i++) {
                    resPW = Integer.toHexString(0xFF & digest2[i]);

                    if (resPW.length() < 2) {
                        resPW = "0" + resPW;
                    }

                    hex2.append(resPW);
                }
                resPW = hex2.toString();

                //if pw entered is the same as default password after super admin reset
                PreparedStatement ps = con.prepareStatement("SELECT username, password, status FROM users WHERE ((type='Admin') AND (username = ?) AND (status<>'disabled'))");
                ps.setString(1, username);

                ResultSet res = ps.executeQuery();

                if (res.next()) {
                    if (res.getString("password").equals(resPW)) {
                        session.setAttribute("username", username);
                        session.setMaxInactiveInterval(3600);
                        response.sendRedirect("admin-reset-page.jsp");
                    } else if (res.getString("password").equals(password)) {
                        session.setAttribute("username", username);
                        session.setMaxInactiveInterval(3600);
                        if (res.getString("username").equals("super")) {
                            response.sendRedirect("superhomepage.jsp");
                        } else {
                            response.sendRedirect("homepage.jsp");
                        }
                    } else {
                        out.println("<script>swal('Error!', 'The password you’ve entered is incorrect. Please try again.', 'error');</script>");
                        out.println("<script>setTimeout(\"window.location.href = 'index.jsp';\",2000);</script>");
                    }
                } else {
                    out.println("<script>swal('Error!', 'The username you’ve entered doesn’t match any account or your account might have been disabled. Please try again.', 'error');</script>");
                    out.println("<script>setTimeout(\"window.location.href = 'index.jsp';\",2000);</script>");
                  
                }

            } catch (SQLException ex) {
                out.println(ex);
            }
        %>
    </body>
</html>
