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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script><script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
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
                PreparedStatement ps = con.prepareStatement("UPDATE users SET status='rejected' WHERE username=?");
                ps.setString(1, username);

                ps.executeUpdate();
                ps = con.prepareStatement("SELECT email, firstname FROM users WHERE username =?");
                ps.setString(1, username);
                ResultSet res = ps.executeQuery();

                while (res.next()) {
                    String email = res.getString("email");
                    String name = res.getString("firstname");
                    String reject ="Thank%20you%20for%20your%20recent%20application%20for%20a%20Qrent%20user%20account.%20Unfortunately,%20you%20do%20not%20meet%20our%20current%20criteria%20for%20account%20approval.%20If%20you%20may%20ask%20why,%20please%20read%20the%20following%20possible%20reasons.%20First,%20you%20must%20provide%20valid%20before%20we%20can%20approve%20your%20application.%20Second,%20you%20have%20previous%20accounts%20that%20have%20been%20disabled%20due%20to%20bad%20records.%20%0D%0A%0D%0AQrent%20Admin%20Team";
                    if (session.getAttribute("username") == null) {
                        response.sendRedirect("index.jsp");
                    } else {
                        
                        out.println("<script>swal('Successful!', 'You have rejected the user account of " + username + "', 'success');</script>");
                        out.println("<script>setTimeout(\"window.location.href = 'approve-accounts.jsp';\",1800);</script>");
                        out.println("<script>window.location.href = 'mailto:" + email + "?subject=Qrent%20Account%20Confirmation&body=Hi%20"+ name +"%20!%0D%0A%0D%0A" + reject + "'</script>");
                    }
                }

            } catch (SQLException ex) {
                out.println(ex);
            }
        %>
    </body>
</html>
