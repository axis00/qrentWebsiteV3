<?php

    /**
    *   search.php
    *
    *   Provides search functionality for the qrent.com
    *
    *   @author David Paul Brackin
    */

    /**
    *   @param string $query The query string that the query from the data base should
    *   @param string $conditions Further conditions to further filter the result. This is appended after the where clause
    *   @return Array An array containing the item rows that match the query string
    */
    function searchForItems($query,$conditions = ""){

        require_once "connectToDb.php";

        global $conn;

        $sql = "SELECT * from Item where match(itemName,itemDescription,itemBrand,itemOwner) against(?) " . $conditions;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$query);
        $stmt->execute();

        $result = $stmt->get_result();
        $res = array();

        for($i = 0; $row = $result->fetch_assoc(); $i++){
                $res[$i] = $row;
        }
        
        return $res;
    }



?>