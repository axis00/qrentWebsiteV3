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
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://rawgit.com/wenzhixin/bootstrap-table/master/src/bootstrap-table.js"></script>
        <link rel="stylesheet" type="text/css" href="https://rawgit.com/wenzhixin/bootstrap-table/master/src/bootstrap-table.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Approve Pending Users</title>
    </head>
    <body id="body">
        <%
            if (session.getAttribute("username") == null) {
                response.sendRedirect("index.jsp");
            }
        %>
        <div class="container">
            <div class="row hidden-xs topper" id="top-nav-container">
                <div class="cols-xs-7 col-sm-7">
                    <a href="homepage.jsp"><img src="qrent-logo.png" id="nav-logo" class="img-responsive"/></a>
                </div>
                <div class="cols-xs-5 col-xs-offset-1 col-sm-offset-0 text-left" id="page-header">
                    <h1>Approve Pending Users</h1>
                </div>
            </div>

           <% if(session.getAttribute("username").equals("super")) {%>
           <%@include file="supernav.html"%>
           <%}else{%>
           <%@include file="nav.html"%>
           <%}%>
              
            <br>
            <div class="row">    
                <div class="col-sm-4">
                    <input class="form-control form-control-sm" id="keyword" type="text" placeholder="Search username, first name, last name, email, etc..." style="width:100%"></input>
                </div>
                <div class="col-sm-1" style="padding:5px;">
                    View:
                </div>
                <div class="col-sm-3" style="padding:5px;">

                    <select class="form-control form-control-sm" id="options" onchange="changepage()">
                        <option value="" hidden>Choose here</option>
                        <option value="1">All Accounts</option>
                        <option value="2" ><b>Enabled Accounts</b></option>
                        <option value="4" selected disable hidden>Disabled Accounts</option>
                        <option value="3" >Rejected Accounts</option>

                     </select>

                    <script>
                        function changepage() {
                            var x = document.getElementById("options").value;
                            if(x == '1'){
                                window.location.href ='manage-users.jsp';
                            }else if(x == '2'){
                                window.location.href ='approved-user.jsp';
                            }else if(x == '3'){
                                window.location.href ='rejected-user.jsp';
                            }else if(x == '4'){
                                window.location.href ='removed-user.jsp';
                            }
                        }
                        
                        $(document).ready(function(){
                            $("#keyword").on("keyup", function() {
                              var value = $(this).val().toLowerCase();
                              $("#users tr").filter(function() {
                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                              });
                            });
                        });
                    </script>
                </div>
            </div>
            <table class="bootstrap-table table table-striped table-no-bordered" data-toggle="table">
                <thead>
                    <tr>
                        <th scope="col" data-field="username" data-sortable="true">Username</th>
                        <th scope="col" data-field="firstname" data-sortable="true">First Name</th>
                        <th scope="col" data-field="lastname" data-sortable="true">Last Name</th>
                        <th scope="col" data-field="email" data-sortable="true">Email</th>
                        <th scope="col" data-field="status" data-sortable="true">Status</th>
                        <th scope="col" data-field="action" data-sortable="true">Action</th>
                        <th scope="col" data-field="type" data-sortable="true">Type</th>
                    </tr>
                </thead>
                <%
                    Connection con;
                    try {
                        Class.forName("com.mysql.jdbc.Driver");
                        con = DriverManager.getConnection("jdbc:mysql://qrentdb.cqmw41ox1som.ap-southeast-1.rds.amazonaws.com/qrent", "root", "letmein12#");

                        response.setContentType("text/html");

                        PreparedStatement ps = con.prepareStatement("SELECT username, firstname, lastname, email, type, status FROM users WHERE status = 'disabled'");

                        ResultSet res = ps.executeQuery();
                        out.println("<tbody id='users'>");
                        while (res.next()) {
                            out.println("<tr scope='row' class='row-hover'>");
                            out.println("<td>" + res.getString("username") + "</td>");
                            out.println("<td>" + res.getString("firstname") + "</td>");
                            out.println("<td>" + res.getString("lastname") + "</td>");
                            out.println("<td>" + res.getString("email") + "</td>");
                            if(res.getString("status").equals("rejected")){
                              out.println("<td><span class=\"badge badge-danger\">" + res.getString("status").toUpperCase() + "</span></td>");  
                              out.println("<td></td>");
                            }else if(res.getString("status").equals("approved")){
                              out.println("<td><span class=\"badge badge-success\">" + res.getString("status").toUpperCase() + "</span></td>");
                              out.println("<td><form action = 'remove-user.jsp' method = 'POST'><input type = 'hidden' name = 'username' value = "
                                    + res.getString("username") + "><input type = 'submit' value = 'DISABLE' class='btn btn-warning btn-sm'></form></td>");
                            }else{
                              out.println("<td><span class=\"badge badge-secondary\">" + res.getString("status").toUpperCase() + "</span></td>"); 
                              out.println("<td><form action = 'reactivate-user.jsp' method = 'POST'><input type = 'hidden' name = 'username' value = "
                                    + res.getString("username") + "><input type = 'submit' value = 'ENABLE' class='btn btn-success btn-sm' ></form></td>");
                            }
                            out.println("<td>" + res.getString("type") + "</td>");
                            out.println("</tr>");
                        }
                        out.println("</tbody>");
                    } catch (SQLException ex) {
                        out.println(ex);
                    }
                %>
            </table>
           </div>
    </body>
</html>
