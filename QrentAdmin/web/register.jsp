
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
                String password = request.getParameter("password");
                
                MessageDigest mdAlgorithm = MessageDigest.getInstance("MD5");
                mdAlgorithm.update(password.getBytes());
                byte[] digest = mdAlgorithm.digest();
                StringBuffer hex = new StringBuffer();
                
                for (int i = 0; i < digest.length; i++){
                    password = Integer.toHexString(0xFF & digest[i]);
                    
                    if (password.length() < 2){
                        password = "0" + password;
                    }
                    
                    hex.append(password);
                }
                password = hex.toString();
                
                String firstname = request.getParameter("firstname");
                String lastname = request.getParameter("lastname");
                String email = request.getParameter("email");
                
                PreparedStatement validate = con.prepareStatement("SELECT USERNAME FROM users where username=?");
                validate.setString(1,username);
                ResultSet val = validate.executeQuery();
                
                if(val.next()){
                    response.sendRedirect("register-page.jsp");
                } else {
                    try {
                        PreparedStatement ps = con.prepareStatement("INSERT INTO `users` (`username`, `password`, `type`, `firstname`, `lastname`, `email`, `status`, `registrationdate`) VALUES (?,?,?,?,?,?,?,?)");
                        ps.setString(1, username);
                        ps.setString(2, password);
                        ps.setString(3, "Admin");
                        ps.setString(4, firstname);
                        ps.setString(5, lastname);
                        ps.setString(6, email);
                        ps.setString(7, "approved");
                        ps.setString(8, LocalDateTime.now().format(formatter));
                
                        ps.execute();
                            
                        response.sendRedirect("registration-confirmation.jsp"); 
                    } catch (SQLException ex){
                        out.println(ex);
                    }
                }
            } catch (SQLException ex) {
                out.println(ex);
            }
        %>
        
    </body>
</html>
