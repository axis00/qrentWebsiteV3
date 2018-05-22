<?php

	/**
    *   helpers.php
    *
    *   A collection of functions meant to help with other operations
    *
    *   @author David Paul Brackin
    */

    include_once '/classes/classes.php';

    /**
    *   @param Integer $itemNo The item number of the item in question
    *   @return Array An integer array of the IDs of the item images
    */
    function getItemImgIDs($itemNo){

    	require_once "connectToDb.php";

    	global $conn;

    	$stmt = $conn->prepare("SELECT itemimageid from `qrent`.`ItemImage` WHERE itemno = ?");
    	$stmt->bind_param("i",$itemNo);
    	$stmt->execute();

    	$queryResult = $stmt->get_result();
    	$res = array();


    	for($i = 0; $row = $queryResult->fetch_assoc(); $i++){
    		$res[$i] = $row['itemimageid'];
    	}

    	return $res;

    }

    /**
	*	A function that returns the featured items
	*	@return Array An array of Item objects
    */
    function getFeaturedItems(){

    	require_once 'connectToDb.php';

    	$sql = "SELECT * FROM `qrent`.`Item` LIMIT 5";

    	global $conn;

    	$stmt = $conn->prepare($sql);
    	$stmt->execute();

    	$queryResult = $stmt->get_result();
    	$res = array();

    	for($i = 0; $row = $queryResult->fetch_assoc(); $i++){
    		$res[$i] = new Item($row);
    	}

    	return $res;

    }

    /**
    *   A function that returns the reservations of the client
    *   @param String $client the username of the client in question
    *   @param String $cond additional query conditions
    *   @return Array An array of reservations
    */
    function getClientReservations($client,$cond = ""){

        require_once 'connecttoDb.php';

        $sql = "SELECT *, datediff(startdate,now()) AS diff FROM qrent.Reservation NATURAL JOIN qrent.Item WHERE client = ? AND status != '' AND status != 'canceled' AND status != 'ongoingrental' AND status != 'endedrental '".$cond;

        global $conn;

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$client);
        $stmt->execute();

        $queryResult = $stmt->get_result();
        $res = array();

        for($i = 0; $row = $queryResult->fetch_assoc(); $i++){
            $res[$i] = $row;
        }

        return $res;

    }

    /**
    *   A function that returns the on going rental of the client
    *   @param String $client the username of the client in question
    *   @param String $cond additional query conditions
    *   @return Array An array of ongoing rentals
    */
    function getClientRentals($client,$cond = ""){

        require_once 'connecttoDb.php';

        $sql = "SELECT *, datediff(enddate,now()) AS diff FROM qrent.Reservation NATURAL JOIN qrent.Item WHERE client = ? AND status = 'ongoingrental' ".$cond;

        global $conn;

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$client);
        $stmt->execute();

        $queryResult = $stmt->get_result();
        $res = array();

        for($i = 0; $row = $queryResult->fetch_assoc(); $i++){
            $res[$i] = $row;
        }

        return $res;

    }
?>