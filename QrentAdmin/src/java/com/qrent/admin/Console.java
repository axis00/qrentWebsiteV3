/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.qrent.admin;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 *
 * @author Kristen
 */
public class Console extends HttpServlet {
    
    static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
    static final String DB_URL="jdbc:mysql://qrentdb.cqmw41ox1som.ap-southeast-1.rds.amazonaws.com/qrent";
    
    static final String USER = "root";
    static final String PASS = "letmein12#";
    
    private Connection con;
    private PreparedStatement ps;
    
    //response.setContentType("text/html");
    
    public void connectToDb() throws SQLException{
        try {
            Class.forName("com.mysql.jdbc.Driver");
            con = DriverManager.getConnection(DB_URL, USER, PASS);
        } catch (ClassNotFoundException | SQLException e){
            e.printStackTrace();
        }   
    }
    

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet Console</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet Consasdole at " + request.getContextPath() + "</h1>");
            out.println("<footer class=\"footer\" \n<div class=\"container\"> \n<span class=\"text-muted\">9331B-G3</span> \n</div> \n</footer> \n</body>");
            out.println("</html>");
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        try {
            connectToDb();
            response.setContentType("text/html");
            PrintWriter out = response.getWriter();

            String username = request.getParameter("username");
            String password = request.getParameter("password");
            
            ps = con.prepareStatement("SELECT username, password FROM users WHERE ((type='Admin') AND (username = ? AND password = ?))");
            ps.setString(1, username);
            ps.setString(2, password);
            
            ResultSet res = ps.executeQuery();
            if (res.next()) {
                HttpSession session = request.getSession();
                out.println("Success");
                session.setAttribute("user", username);
                session.setMaxInactiveInterval(3600);
                out.println(session.getId());
            } else {
                response.sendRedirect("index.html");
            }

        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
