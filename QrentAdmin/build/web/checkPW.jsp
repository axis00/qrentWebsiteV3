
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
                String oldPW = request.getParameter("oldPW");

                PreparedStatement validate = con.prepareStatement("SELECT password FROM users where type='admin' AND username=?");
                validate.setString(1, username);

                ResultSet val = validate.executeQuery();
                

                if (val.next()) {
                    String currPW = val.getString("password");
                    
                    MessageDigest mdAlgorithm = MessageDigest.getInstance("MD5");
                    mdAlgorithm.update(oldPW.getBytes());
                    byte[] digest = mdAlgorithm.digest();
                    StringBuffer hex = new StringBuffer();

                    for (int i = 0; i < digest.length; i++) {
                        oldPW = Integer.toHexString(0xFF & digest[i]);

                        if (oldPW.length() < 2) {
                            oldPW = "0" + oldPW;
                        }

                        hex.append(oldPW);
                    }
                    oldPW = hex.toString();

                    if (oldPW.equals(currPW)){
                        out.println("OK");
                    } else {
                        out.println("Wrong Password.");
                    }
                }

            } catch (SQLException ex) {
                out.println(ex);
            }
        %>
    </body>
</html>
