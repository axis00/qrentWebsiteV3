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

?>